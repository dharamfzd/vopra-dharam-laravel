<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Number;
use App\Models\Price;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totals = Price::Where('user_id', Auth::id())
                        ->selectRaw("SUM(price) as total_price, field_id")
                        ->groupBy('field_id')
                        ->get();
        $numbers = Number::all();

        return view('home', compact('numbers', 'totals'));
    }
}
