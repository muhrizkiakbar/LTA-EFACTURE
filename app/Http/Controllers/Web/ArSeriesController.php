<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArInvoice;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use App\Models\Branch;
use App\Actions\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ArSeriesController extends Controller
{
    public function index(Request $request) {
        $company = Inertia::getShared('company');
        $filters = array_merge([
            'branch' => '3',
            'limit' => 10
        ], $request->only([
            'search',
            'branch',
        ]));
        $series = ArInvoice::filter($filters)
        ->where('status', $request->get('status') ?? 0)
        ->where('company_id', $company)
        ->orderBy('created_at', 'desc')
        ->paginate($request->get('limit') ?? 10)->through(function($i){
            return [
                "id" => $i->id,
                "DocNum" => $i->DocNum,
                "CardCode" => $i->CardCode,
                "CardName" => $i->CardName,
                "Street" => $i->Street,
                "LicTradNum" => $i->LicTradNum,
                "status" => $i->status,
                "branch_id" => $i->branch->title,
                "company_id" => $i->company_id,
                "posting_date" => $i->posting_date,
                "key" => $i->keys,
                "time" => [
                    "sync" => $i->created_at->format('d-m-Y'),
                    "updated" => $i->updated_at->diffForHumans(),
                ]
            ];
        });
        return Inertia::render('ArSeries/Index', [
            'series' => $series,
            'branch' => Branch::all(),
            'filters' => $filters,
            'status' => $request->get('status') ?? 0,
            'recap' => $this->recap($filters['branch']),
        ]);
    }
    public function update(Request $request) {
        $company = Inertia::getShared('company');
        $docnum = $request->input('docnum');
        $invoice = ArInvoice::where('docnum', $docnum)->first();

        $url = env('ERP_API_URL');
        $fetch = Http::post(sprintf('%supdateInvoiceFP', $url), [
            "NoSeriesPajak" => $request->input('series'),
            "TanggalFakturPajak" => $request->input('date'),
            "Address" => $request->input('address'),
            "DocNum" => $request->input('docnum'),
            "CompanyId" => $company 
        ]);

        $res = json_decode($fetch->body(), true);
        $invoice->update([
            'status' => 2
        ]);

        (new Alert)('success', sprintf("%s berhasil terupdate", $invoice->docnum));
        return redirect()->back();
    }
    public function multipleUpdate(Request $request ) {
        $company = Inertia::getShared('company');
        $data = $request->input('invoices');
        $url = env('ERP_API_URL');

        foreach ($data as $item) {
            $find = ArInvoice::where('docnum', $item['docnum'])->with('keys')->first();
            // array_push($invoices, $find);
            $fetch = Http::post(sprintf('%supdateInvoiceFP', $url), [
                "NoSeriesPajak" => $find->keys->series,
                "TanggalFakturPajak" => $find->posting_date,
                "Address" => $find->Street,
                "DocNum" => $find->DocNum,
                "CompanyId" => $company 
            ]);
            $res = json_decode($fetch->body(), true);
            $find->update([
                'status' => 2
            ]);
        }

        // return $company;

        (new Alert)('success', sprintf("A/R Invoice berhasil terupdate"));
        return redirect()->back();
    }
    function recap ($branch) {
        $month = Carbon::now()->format('m');
        $series = ArInvoice::where('branch_id', $branch)->whereMonth('created_at', $month)->get();
        $recap = [
            'new' => $series->where('status', 0)->count(),
            'progress' => $series->where('status', 1)->count(),
            'updated' => $series->where('status', 2)->count(),
        ];
        return $recap;
    }
    public function rollback(Request $request)
    {
        if($request->input('id'))
        {
            $ar = ArInvoice::where('id', $request->input('id'))->first();
            $ar->status = 0;
            $ar->save();
            (new Alert)('success', sprintf("Data berhasil diproses."));
            return redirect()->back();
        }else {
            (new Alert)('success', sprintf("ID tidak ditemukan, Data tidak dapat diproses"));
            return redirect()->back();
        }
    }
}
