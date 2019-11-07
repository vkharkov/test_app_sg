<?php

namespace App\Http\Controllers;

use App\Entities\Gift;
use App\Entities\Prize;
use App\Managers\PrizeManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send(Request $request)
    {
        return view('home');
    }

}
