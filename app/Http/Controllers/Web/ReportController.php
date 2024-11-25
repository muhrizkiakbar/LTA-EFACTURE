<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\ArInvoice;
use App\Models\Branch;
use App\Models\KeySeries;

class ReportController extends Controller
{
    public function __construct() {
        $this->month = \Carbon\Carbon::now()->format('m');
        $this->year = \Carbon\Carbon::now()->format('Y');
    }
    public function index(Request $request) {
        $invoices = ArInvoice::with('branch')->whereMonth('created_at', $this->month)
        ->whereYear('created_at', $this->year)->get();
        // total recap
        $branchRecap = $invoices->groupBy('branch_id')->transform(function($item) {
            return [
                'new' => $item->where('status', 0)->count(),
                'progress' => $item->where('status', 1)->count(),
                'updated' => $item->where('status', 2)->count(),
                'all' => $item->count(),
            ];
        });
        // totalREcap
        $totalRecap = [
            'new' => $invoices->where('status', 0)->count(),
            'progress' => $invoices->where('status', 1)->count(),
            'updated' => $invoices->where('status', 2)->count(),
            'all' => $invoices->count(),
        ];
        // return $this->invoiceChart();
        return Inertia::render('Report/Index', [
            'branch' => $branchRecap,
            'total' => $totalRecap,
            'time' => sprintf('%s, %s', \Carbon\Carbon::now()->format('F'), $this->year),
            'branches' => Branch::all(),
            'chart' => [
                'keysSeries' => $this->keyChart(),
                'invoices' => $this->invoiceChart(),
            ],
            'keySeries' => [
                'data' => [KeySeries::where('status', '0')->count(), KeySeries::where('status', '1')->count()]
            ]
        ]);
    }
    function keyChart() {
        $firstWeek = \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d');
        $LastWeek = \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d');
        
        $keys = KeySeries::whereMonth('created_at', $this->month)
        ->whereYear('created_at', $this->year)->get();

        $grouping = $keys->groupBy(function($item) {
            return \Carbon\Carbon::createFromFormat('Y-m-d', $item->date);
        })->mapWithKeys(fn($item, $index) => [
            \Carbon\Carbon::parse($index)->format('d-m-Y') => $item->count()
        ]);

        $labels = [];
        $data = [];

        foreach ($grouping as $index => $item) {
           array_push($labels, $index);
        }
        foreach ($grouping as $index => $item) {
            array_push($data, $item);
         }

        return compact('labels', 'data');
    }
    function invoiceChart() {
        $firstWeek = \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d');
        $LastWeek = \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d');
        
        $invoice = ArInvoice::whereMonth('created_at', $this->month)
        ->whereYear('created_at', $this->year)->get();

        // return $invoice->groupBy('created_at');

        $grouping = $invoice->groupBy(function($item) {
            return $item->created_at;
        })->mapWithKeys(fn($item, $index) => [
            \Carbon\Carbon::parse($index)->format('d-m-Y') => $item->count()
        ]);

        $labels = [];
        $data = [];

        foreach ($grouping as $index => $item) {
           array_push($labels, $index);
        }
        foreach ($grouping as $index => $item) {
            array_push($data, $item);
         }

        return compact('labels', 'data');
    }

}
