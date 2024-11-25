<?php

namespace App\Http\Controllers\Web\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\ArInvoice;
use App\Models\Branch;
use App\Models\KeySeries;

class SapReportController extends Controller
{
    public function __construct() {
        $this->url = env('ERP_API_URL');
    }
    public function index(Request $request) {
        $response = Http::post(sprintf('%sgenerateInvoiceFP', $this->url), [
            "DocDateFrom" => $request->get('dateStart'),
            "DocDateTo" => $request->get('dateEnd'),
            "Branch" => $request->get('branch')
        ]);
        $data = json_decode($response->body());
        $collect = collect($data->data)->transform(fn($i) => [
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

        $report = [
            'count' => [
                'total' => $collect->count(),
                'valid' =>  $collect->where('isValid', true)->count(),
                'invalid' =>  $collect->where('isValid', false)->count(),
                'integrate' => $collect->whereNotNull('NSFP')->count(),
                'notIntegrate' => $collect->whereNull('NSFP')->count(),
            ],
            'data' => [
                'invalid' => [...$collect->where('isValid', false)]
            ]
        ];

        return Inertia::render('Report/Sap', [
            ...$report,
            'filter' => [
                'branch' => $request->get('branch'),
                'dateStart' => $request->get('dateStart'),
                'dateEnd' => $request->get('dateEnd'),
            ]
        ]);
    }
}