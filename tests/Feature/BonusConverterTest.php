<?php

namespace Tests\Feature;

use App\Entities\Prize;
use App\Managers\PrizeManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BonusConverterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConverter()
    {
        $prize = Prize::where('type','=', Prize::PRIZE_TYPE_MONEY)
            ->whereNotNull('user_id')
            ->orderBy('created_at','desc')
            ->first();

        $pm = new PrizeManager($prize->user, clone $prize);

        $convertedPrize = $pm->convertToBonus();

        $this->assertEquals(
            round( (float) $prize->value * Prize::MONEY_TO_BONUS_EXCHANGE_FACTOR),
            $convertedPrize->value
        );

    }
}
