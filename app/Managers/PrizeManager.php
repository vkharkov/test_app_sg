<?php

namespace App\Managers;

use App\Entities\Gift;
use App\Entities\Prize;
use App\User;
use Illuminate\Support\Arr;

class PrizeManager
{

    /**
     * @var User $user
     */
    private $user = null;

    /**
     * @var Prize $prize
     */
    private $prize = null;

    /**
     * PrizeManager constructor.
     * @param User|null $user
     * @param Prize|null $prize
     */
    public function __construct(User $user = null, Prize $prize = null)
    {
        $this->user = $user;
        $this->prize = $prize;
    }

    /**
     * @param User|null $user
     * @throws \Exception
     */
    public function setUser(User $user = null)
    {

        if ( $user === null )
            throw new \Exception("User can't be null");

        $this->user = $user;
    }

    /**
     * @param Prize|null $prize
     * @throws \Exception
     */
    public function setPrize(Prize $prize = null)
    {

        if ( $prize === null )
            throw new \Exception("Prize can't be null");

        $this->prize = $prize;
    }

    public function generatePrize()
    {

        $type = array_rand(Prize::getPrizeTypes());

        $prize = new Prize([
            'type' => Prize::getPrizeTypes()[$type],
        ]);

        if ( $prize->makePrize() === true ) {
            $prize->save();
            return $prize;
        }

        return null;

    }

    public function declinePrize()
    {

        if ( $this->prize->collected_at !== null )
            throw new \Exception('Prize already collected');

        $this->prize->declined_at = time();
        $this->prize->user_id = $this->user->id;

        return $this->prize->save();

    }

    public function collectPrize()
    {

        if ( $this->prize->collected_at !== null )
            throw new \Exception('Prize already collected');

        if ( $this->prize->declined_at !== null )
            throw new \Exception('Prize already declined');

        $this->prize->collected_at = time();
        $this->prize->user_id = $this->user->id;
        $this->prize->save();

        if ( $this->prize->type === Prize::PRIZE_TYPE_BONUS ) {
             $this->user->collectBonus($this->prize);
        }

        if ( $this->prize->type === Prize::PRIZE_TYPE_ITEM ) {

            $gift = Gift::where('id','=',$this->prize->value)
                ->first();

            $gift->quantity = $gift->quantity - 1;
            $gift->save();

        }

        return $this->prize->save();

    }

    public function convertToBonus()
    {

        if ( $this->prize->collected_at !== null )
            throw new \Exception('Prize already collected');

        if ( $this->prize->declined_at !== null )
            throw new \Exception('Prize already declined');

        if ( $this->prize->type !== Prize::PRIZE_TYPE_MONEY )
            throw new \Exception('Can convert only money prize');

        $this->prize->type = Prize::PRIZE_TYPE_BONUS;
        $this->prize->value = round($this->prize->value * Prize::MONEY_TO_BONUS_EXCHANGE_FACTOR);

        return $this->prize->save();

    }





}