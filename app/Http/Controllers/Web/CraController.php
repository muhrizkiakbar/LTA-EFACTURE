<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class CraController extends Controller
{
    public function index() {
        // session()->flash('flash.banner', 'Yay for free components!');
        return Inertia::render('Cra/Index');
    }
}
