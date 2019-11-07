<?php

namespace App\Managers;

use App\Entities\Gift;

class GiftManager
{

    /**
     * @var Gift $gift
     */
    private $gift = null;

    /**
     * GiftManager constructor.
     * @param Gift|null $gift
     */
    public function __construct(Gift $gift = null)
    {
        $this->gift = $gift;
    }

    /**
     * @param Gift|null $gift
     * @throws \Exception
     */
    public function setGift(Gift $gift = null)
    {

        if ( $gift === null )
            throw new \Exception("Gift can't be null");

        $this->gift = $gift;
    }

    /**
     * @return mixed Gift|null
     */
    public static function getRandomGift()
    {

        return Gift::where('quantity','>',0)
            ->where('available','=',1)
            ->orderBy('rand')
            ->limit(1)
            ->first();

    }

}
