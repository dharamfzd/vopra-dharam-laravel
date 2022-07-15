<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Number;

class NumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[];

        for($i=1; $i<=100; $i++) {
          $data[] = [
            'number'      =>  $i,
            'created_at'  =>  now(),
            'updated_at'  =>  now()
          ];
        }

        Number::insert($data);
    }
}
