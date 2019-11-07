<?php

namespace App\Http\Controllers;

use App\Managers\PrizeManager;
use Illuminate\Http\Request;

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
        return view('home');
    }

    public function getPrize(Request $request)
    {

        return view('prize.getPrize');

    }

    public function generatePrize(Request $request)
    {

        return view('prize.generatePrize');

    }

    public function resultPrize(Request $request, PrizeManager $pm)
    {

        $prize = $pm->generatePrize();

        return view(
            'prize.resultPrize',
            [
                'prize' => $prize
            ]);

    }
}
