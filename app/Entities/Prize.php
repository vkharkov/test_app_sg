<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Prize extends Model
{

    const
        PRIZE_TYPE_ITEM = 1,
        PRIZE_TYPE_BONUS = 2,
        PRIZE_TYPE_MONEY = 3;

    const
        TOTAL_MONEY_AMOUNT = 1000000000;

    const
        MIN_BONUS_PRIZE = 100,
        MAX_BONUS_PRIZE = 3000,
        MIN_MONEY_PRIZE = 1000,
        MAX_MONEY_PRIZE = 5000;

    const
        MONEY_TO_BONUS_EXCHANGE_FACTOR = 0.01;

    protected $fillable = [
        'type',
        'value',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'sended_at',
        'collected_at'
    ];

    public static function getPrizeTypes()
    {
        $reflectionClass = new \ReflectionClass(self::class);
        $constants = $reflectionClass->getConstants();

        foreach ($constants as $key => $value ) {
            if ( (bool) preg_match('/PRIZE_TYPE/', $key) === false ) {
                unset($constants[$key]);
            }
        }

        return $constants;
    }

    public function makePrize()
    {
        if ( $this->type === null )
            throw new \Exception('Type cant be null');

        if ( $this->value !== null )
            throw new \Exception('Value already set');

        $totalSpent = Prize::where('type','=',self::PRIZE_TYPE_MONEY)
            ->whereNotNull('sended_at')
            ->sum('value');

        if ( $totalSpent === self::TOTAL_MONEY_AMOUNT )
            $this->type = self::PRIZE_TYPE_BONUS;

        switch ($this->type) {

            case self::PRIZE_TYPE_ITEM:

                $gift = Gift::where('quantity','>',0)
                    ->where('available','=',1)
                    ->orderByRaw('RAND()')
                    ->first();

                $this->value = $gift->id;
                break;

            case self::PRIZE_TYPE_BONUS:

                $this->value = rand(self::MIN_BONUS_PRIZE, self::MAX_BONUS_PRIZE);
                break;

            case self::PRIZE_TYPE_MONEY:

                $this->value = rand(self::MIN_MONEY_PRIZE, self::MAX_BONUS_PRIZE);

                if ( $this->value + $totalSpent > self::TOTAL_MONEY_AMOUNT )
                    $this->value = self::TOTAL_MONEY_AMOUNT - $totalSpent;

                break;

        }

        if ( $this->value === null )
            throw new \Exception('Prize value generation failed');

        return true;

    }
}
