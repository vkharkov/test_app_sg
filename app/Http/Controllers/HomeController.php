<?php

namespace App\Http\Controllers;

use App\Entities\Gift;
use App\Entities\Prize;
use App\Managers\PrizeManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ( $prize->type === Prize::PRIZE_TYPE_ITEM )
            $gift = Gift::where('id','=',$prize->value)->first();
        else
            $gift = null;

        return view(
            'prize.resultPrize',
            [
                'prize' => $prize,
                'gift' => $gift,
                'user' => Auth::user()
            ]);

    }

    public function declinePrize(Request $request, PrizeManager $pm)
    {

        $rules = [
            'prizeId' => 'integer|required'
        ];

        $this->validate($request, $rules);

        $user = Auth::user();

        $prize = Prize::where('id','=', $request->get('prizeId'))->first();

        if ( $prize === null )
            throw new \Exception('Prize cant be null');

        $pm->setUser($user);
        $pm->setPrize($prize);

        return [
            'status' => $pm->declinePrize()
        ];

    }

    public function collectPrize(Request $request, PrizeManager $pm)
    {

        $rules = [
            'prizeId' => 'integer|required'
        ];

        $this->validate($request, $rules);

        $user = Auth::user();

        $prize = Prize::where('id','=', $request->get('prizeId'))->first();

        if ( $prize === null )
            throw new \Exception('Prize cant be null');

        $pm->setUser($user);
        $pm->setPrize($prize);

        return [
            'status' => $pm->collectPrize()
        ];

    }

    public function convertToBonus(Request $request, PrizeManager $pm)
    {

        $rules = [
            'prizeId' => 'integer|required'
        ];

        $this->validate($request, $rules);

        $user = Auth::user();

        $prize = Prize::where('id','=', $request->get('prizeId'))->first();

        if ( $prize === null )
            throw new \Exception('Prize cant be null');

        $pm->setUser($user);
        $pm->setPrize($prize);

        if ( $pm->convertToBonus() === true ) {

            return [
                'status' => $pm->collectPrize()
            ];

        }

        return [
            'status' => false
        ];

    }

    public function gameOver(Request $request)
    {
        return view('prize.gameover');
    }
}
