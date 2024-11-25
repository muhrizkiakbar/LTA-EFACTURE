<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class SyncController extends Controller
{
    public function arInvoice() {
        // $url = env('ERP_API_URL');
        // $response = Http::post(sprintf('%sgenerateInvoiceFP', $url), [
        //     "DocDateFrom" => $request->get('dateStart'),
        //     "DocDateTo" => $request->get('dateEnd'),
        //     "Branch" => $request->get('branch')
        // ]);
        // $data = json_decode($response->body());
        
        return Inertia::render('ArInvoice/Index');
    }
}
