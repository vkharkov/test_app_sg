<?php

namespace App\Managers;

use App\Entities\Gift;
use App\Entities\Prize;
use App\User;
use http\Client;

class BankingManager
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client = null;

    /**
     * @var User
     */
    private $user = null;

    /**
     * @var Prize
     */
    private $prize = null;

    /**
     * BankingManager constructor.
     * @param Gift|null $gift
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

    public function sendMoneyToUserAccount()
    {

        if ($this->user === null)
            throw new \Exception('User cant be null');

        if ( $this->prize->sended_at !== null )
            throw new \Exception('Money already sended');

        if ( $this->prize->type !== Prize::PRIZE_TYPE_MONEY )
            throw new \Exception('Prize should by money type');


        $client = $this->getClient();
        $result = $client->get(
            'http://127.0.0.1:8000/fakeBank',
            [
                'userId' => $this->user->id,
                'amount' => $this->prize->value
            ]
        );

        if ( !$result->getStatusCode() === 200 )
            throw new \Exception("Bank request error: {$result->getStatusCode()} {$result->getReasonPhrase()}");

        $this->prize->sended_at = time();
        $this->prize->save();

        return true;

    }

    private function getClient()
    {

        /**
         * It's better to do BankClient class or BankInterface
         */
        if ( $this->client === null ) {
            $this->client = new \GuzzleHttp\Client();
        }

        return $this->client;

    }

}
