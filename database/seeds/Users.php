<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{

    /**
     * @var array Default users
     *
     * Feel free to use as validation rule
     */
    public static $defaultUsers = [
        [
            'name' => 'User1',
            'mail' => 'user1@mail.ru',
            'pass' => 'qwe123'
        ],
        [
            'name' => 'User2',
            'mail' => 'user2@mail.ru',
            'pass' => 'qwe123'
        ],
        [
            'name' => 'User3',
            'mail' => 'user3@mail.ru',
            'pass' => 'qwe123'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (self::$defaultUsers as $user ) {

            DB::table('users')->insert([
                'name' =>  $user['name'],
                'email' => $user['mail'],
                'password' => bcrypt($user['pass']),
            ]);

        }
    }
}
