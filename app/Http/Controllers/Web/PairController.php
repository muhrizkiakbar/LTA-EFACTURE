<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Alert;
use App\Models\KeySeries;
use App\Models\ArSeries;
use App\Models\ArInvoice;

class PairController extends Controller
{
    public function store(Request $request) {
        $this->updateKey($request->input('keyId'), $request->input('ar_series'));
        $this->updateInvoice($request->input('ar_series'));
        (new Alert)('success', 'NSFP berhasil ditambahkan');
        return redirect()->back();
    }
    public function multiPairing(Request $request){
        $data = $request->input('invoices');
        foreach ($data as $item) {
            $this->updateKey($item['key_id'], $item['invoice_id']);
            $this->updateInvoice($item['invoice_id']);
        }
        (new Alert)('success', 'NSFP berhasil ditambahkan');
        return redirect()->route('arSeries.index');
    }
    function updateKey($key, $invoice) {
        $keySeries = KeySeries::find($key);
        $keySeries->update([
            'ar_invoice_id' => $invoice,
            'status' => '1'
        ]);
        return $keySeries;
    }
    function updateInvoice($invoice){
        $data = ArInvoice::find($invoice);
        $data->update([
            'status' => '1'
        ]);
    }
    
}
