<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Actions\Alert;
use App\Models\KeySeries;
use Illuminate\Support\Facades\Session;

class KeySeriesController extends Controller
{
    // public function index()
    // {
    //     $company = Inertia::getShared('company');
    //     $series = KeySeries::where('company_id', $company)
    //         ->orderBy('date', 'desc')
    //         ->get()
    //         ->groupBy('date');

    //     $series->transform(function ($item) {
    //         return [
    //             'total' => $item->count(),
    //             'first' => $item[0]->series,
    //             'last' => $item[$item->count() - 1]['series'],
    //             'used' => $item->where('status', 1)->count(),
    //             'unused' => $item->where('status', 0)->count()
    //         ];
    //     });

    //     // return $series;

    //     return Inertia::render('KeySeries/Index', [
    //         'series' => $series
    //     ]);
    // }

    public function index()
    {
        $company = Inertia::getShared('company');

        // Select only the necessary columns to reduce memory usage
        $series = KeySeries::select('series', 'date', 'status')
            ->where('company_id', $company)
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('date');

        // Transform the collection more efficiently
        $transformedSeries = $series->map(function ($items, $date) {
            $firstSeries = $items->first();
            $lastSeries = $items->last();

            $usedCount = 0;
            $unusedCount = 0;

            foreach ($items as $item) {
                if ($item->status == 1) {
                    $usedCount++;
                } else {
                    $unusedCount++;
                }
            }

            return [
                'total' => $items->count(),
                'first' => $firstSeries->series,
                'last' => $lastSeries->series,
                'used' => $usedCount,
                'unused' => $unusedCount
            ];
        });

        return Inertia::render('KeySeries/Index', [
            'series' => $transformedSeries
        ]);
    }

    public function detail($date)
    {
        $company = Inertia::getShared('company');

        $series = KeySeries::where('date', $date)
            ->where('company_id', $company)
            ->with('invoice')->get();

        return Inertia::render('KeySeries/Detail', [
            'params' => $date,
            'series' => $series
        ]);
    }
    public function store(Request $request)
    {
        $company = Inertia::getShared('company');
        $series = $request->input('series');
        $request->validate([
            'date' => 'required',
            'series' => "required"
        ]);
        foreach ($series as $item) {
            KeySeries::create([
                'date' => $request->input('date'),
                'series' => $item,
                'company_id' => $company
            ]);
        }
        return redirect()->route('keySeries.index');
    }
    public function update(Request $request, KeySeries $KeySeries)
    {
        $KeySeries->update([
            'series' => $request->input('series')
        ]);
        (new Alert)('success', "Update nomer serial faktur pajak berhasil !");
        return redirect()->back();
    }
    public function check(Request $request)
    {
        $response = KeySeries::where('series', $request->get('series'))->first();
        return response()->json($response);
    }

    public function keyGenerate()
    {
        $company = Inertia::getShared('company');
        $response = KeySeries::where(['status' => '0', 'ar_invoice_id' => null, 'company_id' => $company])->first();
        return response()->json($response);
    }

    public function multiGenerate($limit)
    {
        $company = Inertia::getShared('company');
        $response = KeySeries::where(['status' => '0', 'ar_invoice_id' => null, 'company_id' => $company])->paginate($limit);
        return response()->json($response);
    }
}
