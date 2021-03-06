<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Gifts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Pseudo random gifts array
         */
        $gifts = array_map(function ($id){
                return [
                    'name' => 'Gift #' . $id,
                    'description' => 'This gift is autogenerated.',
                    'quantity' => rand(10,100),
                    'available' => 1
                ];
            },
            range(1, 10)
        );

        if ( DB::table('gifts')->where('available','>', '1')->count('id') === 0 ) {
            DB::table('gifts')->insert($gifts);
        }

    }
}
