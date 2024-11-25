<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cra;
use App\Models\User;
use App\Models\Task;
// xls
use App\Imports\CrasImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;

class MasterCraController extends Controller
{
    public function __invoke(Request $request) {
        $filters = array_merge([
            'sort' => 'desc',
            'size' => '20',
        ], $request->only([
            'trashed',
            'search',
            'sort',
            'date',
            'status'
        ]));

        $cra = Cra::filter($filters)->paginate($request->size ?? 20);
        $user = User::all();
        return Inertia::render('Master/Cra/Index', [
            'cra' => $cra,
            'filters' => $filters,
            'user' => $user
        ]); 
    }

    public function import(Request $request) {
        $cra = Excel::import(new CrasImport, $request->file('file'));
        session()->flash('flash.banner', 'File telah terupload ');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->back();
    }

    public function create() {
        return Inertia::render('Master/Cra/Create');
    }

    public function store (Request $request) {
        $request->validate([
            'bp_code' => ['required'],
            'bp_name'=> ['required'],
            'type' => ['required'],
            'doc_num' => ['required'], 
            'bp_ref_no' => ['required'],
            'original_amount'  => ['required'],
            'balance_due'  => ['required'],
            'pt'  => ['required'],
            'branch'  => ['required'],
        ], [], [
            'bp_code' => 'BP. CODE',
            'bp_name'=> 'BP. NAME',
            'type' => 'TYPE',
            'doc_num' => 'DOC. NUM', 
            'bp_ref_no' => 'BP. REF NO',
            'original_amount'  => 'ORIGINAL AMOUNT',
            'balance_due'  => 'BALANCE DUE',
            'pt'  => 'PT',
            'branch'  => 'BRANC',
        ]);

        $cra = Cra::create($request->except(['add_other']));
        
        if ($request->input('add_other')) {
            session()->flash('flash.banner', 'Cra berhasil ditambahkan');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->back();
        }else {
            session()->flash('flash.banner', 'Cra berhasil ditambahkan');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('masterCra');
        }
    }
    public function addTask(Request $request) {
        $request->validate([
            'tasks' => 'required|min:1',
            'assigned' => 'required'
        ]);
        
        $task = $request->input('tasks');
        foreach ($task as $item) {
            Task::create([
                'delivery_date' => $item['delivery_date'],
                'posting_date' => $item['post_date'],
                'bp_code' => $item['bp_code'],
                'bp_name' => $item['bp_name'],
                'doc_num' => $item['doc_num'],
                'bp_ref_no' => $item['bp_ref_no'],
                'original_amount' => $item['original_amount'],
                'balance_due' => $item['balance_due'],
                'user_id' => Auth::user()->id,
                'assigned' => $request->input('assigned'),
            ]);
        }
        session()->flash('flash.banner', 'Tasks berhasil ditambahkan');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('task');
    }
}
