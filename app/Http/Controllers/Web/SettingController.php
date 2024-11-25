<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Company;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function changeCompany(Request $request)
    {
        // return $request->all();
        Session::put('company', $request->input('id'));
        $compid = Session::get('company');
        $active = Company::where('status', "1")->get();

        foreach ($active as $item) {
            $item->update([
                'status' => "0"
            ]);
        }

        $comp = Company::where('id_erp', $compid)->first();
        $comp->update([
            'status' => "1"
        ]);
        return redirect()->back();
    }
}
