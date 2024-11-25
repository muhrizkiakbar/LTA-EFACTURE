<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoiceExport;
use App\Actions\Alert;
use Carbon\Carbon;

use App\Models\ArInvoice;
use App\Models\Branch;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ArInvoiceController extends Controller
{
    public function index(Request $request) {
        $company = Inertia::getShared('company');
        $url = env('ERP_API_URL');
        $response = Http::post(sprintf('%sgenerateInvoiceFP', $url), [
            "DocDateFrom" => $request->get('dateStart'),
            "DocDateTo" => $request->get('dateEnd'),
            "Branch" => $request->get('branch'),
            "CompanyId" => $company
        ]);
        $data = json_decode($response->body());
        $inv = collect($data->data);
        // find duplicate data
        $coll = $inv->unique(function($item) {
            return $item->DocNum;
        });
        // init array 
        $arrInvoice = [];
        // store array object to array 
        foreach ($coll as $key => $value) {
            $arrInvoice[] = $value;
        }

        // return $arrInvoice;
        // transform array
        $collect = collect($arrInvoice)->transform(fn($i) => [
            'DocNum' => $i->DocNum,
            'CardCode' => $i->CardCode,
            'CardName' => $i->CardName,
            'Street' => $i->Street,
            'LicTradNum' => $i->LicTradNum,
            'NIK' => $i->U_NIK, 
            'NSFP' => $i->U_VATONO,
            'NumAtCard' => $i->NumAtCard,
            'DocDate' => Carbon::parse($i->DocDate)->format('Y-m-d'),
            'isValid' => $i->LicTradNum != "00.000.000.0-000.000" && isset($i->LicTradNum) || isset($i->U_NIK)
        ]);
       

        return Inertia::render('ArInvoice/Index', [
            'invoice' => $collect,
            'filter' => [
                'branch' => $request->get('branch'),
                'dateStart' => $request->get('dateStart'),
                'dateEnd' => $request->get('dateEnd'),
                'company' => $company,
            ],
            'branch' => Branch::all(),
        ]);
    }
    public function store(Request $request) {
       $request->validate([
            'DocNum' => 'required|unique:ar_invoices,DocNum',
            'CardCode' => 'required',
            'CardName' => 'required',
            'Street' => 'required',
            'LicTradNum' => 'required',
            'status' => 'required',
            'branch_id' => 'required',
        ]);
        
        $invoice = ArInvoice::create([
            'DocNum' => $request->input('DocNum'),
            'CardCode' => $request->input('CardCode'),
            'CardName' => $request->input('CardName'),
            'Street' => $request->input('Street'),
            'LicTradNum' => $request->input('LicTradNum'),
            'status' => $request->input('status'),
            'branch_id' => $request->input('branch_id'),
            'company_id' => $request->input('company_id'),
            'posting_date' => $request->input('posting_date'),
        ]);
        (new Alert)('success', sprintf('%s berhasil ditambahkan', $invoice->DocNum));
        return redirect()->back();
    }
    public function multipleStore(Request $request){
        $invoices = $request->input('invoices');
        foreach ($invoices as $item) {
            ArInvoice::create([
                'DocNum' => $item['DocNum'],
                'CardCode' => $item['CardCode'],
                'CardName' => $item['CardName'],
                'Street' => $item['Street'],
                'LicTradNum' => $item['LicTradNum'],
                'status' => "0",
                'branch_id' => $request->input('branch'),
                'company_id' => $item['company_id'],
                'posting_date' => $item['DocDate'],
            ]);
        }
        (new Alert)('success', sprintf('Data berhasil ditambahkan'));
        return redirect()->back();
    }
    public function exportExcel(Request $request) {
        $company = Inertia::getShared('company');
        $url = env('ERP_API_URL');
        $response = Http::post(sprintf('%sgenerateInvoiceFP', $url), [
            "DocDateFrom" => $request->get('from'),
            "DocDateTo" => $request->get('to'),
            "Branch" => $request->get('cabang'),
            "CompanyId" => $company
        ]);
        $data = json_decode($response->body());
        $collect = collect($data?->data)
        ->transform(fn($i) => [
            'DocNum' => $i->DocNum,
            'CardCode' => $i->CardCode,
            'CardName' => $i->CardName,
            'Street' => $i->Street,
            'LicTradNum' => $i->LicTradNum,
            'NIK' => $i->U_NIK,
            'NSFP' => $i->U_VATONO,
            'NumAtCard' => $i->NumAtCard,
            'DocDate' => Carbon::parse($i->DocDate)->format('Y-m-d'),
        ]);

        if ($collect->count() > 0) {
            $writer = SimpleExcelWriter::streamDownload('faktur-report.xlsx');
            
            foreach ($collect as $key => $item) {
                $writer->addRow($item);

                if ($key % 1000 === 0) {
                    flush(); // Flush the buffer every 1000 rows
                }
            }
        } else {
            return "data report kosong";
        }
    }
}
