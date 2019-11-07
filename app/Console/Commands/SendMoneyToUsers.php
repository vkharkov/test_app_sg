<?php

namespace App\Console\Commands;

use App\Entities\Prize;
use App\Managers\BankingManager;
use Illuminate\Console\Command;

class SendMoneyToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:send {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends money to users bank accounts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(BankingManager $bm)
    {

        $this->info('Count: ' . $this->argument('count', 100));

        $prizes = Prize::where('type','=', Prize::PRIZE_TYPE_MONEY)
            ->whereNull('sended_at')
            ->whereNotNull('user_id')
            ->orderBy('collected_at','desc')
            ->limit( $this->argument('count', 100) )
            ->get();

        $this->info('Total unsent prizes: ' . $prizes->count());

        foreach ($prizes as $prize) {

            $this->info(' Processing prize : ' . $prize->id);

            $bm->setUser($prize->user);
            $bm->setPrize($prize);

            $this->info(' Sending amount: ' . $prize->value . ' to User: ' . $prize->user->id);

            if ( $bm->sendMoneyToUserAccount() )
                $this->info(' ! Success !');
            else
                $this->info(' ! Error !');


        }

    }
}
