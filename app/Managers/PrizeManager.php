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

}
