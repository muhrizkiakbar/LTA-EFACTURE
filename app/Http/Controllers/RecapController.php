<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArInvoice;
use Carbon\Carbon;
class RecapController extends Controller
{
    public function arseries(Request $request) {
        // return $request->all();
        $month = Carbon::now()->format('m');
        $series = ArInvoice::where('branch_id', $request->get('branch'))->whereMonth('created_at', $month)->get();

        $recap = [
            'new' => $series->where('status', 0)->count(),
            'progress' => $series->where('status', 1)->count(),
            'updated' => $series->where('status', 2)->count(),
        ];
        return $recap;
    }
}
