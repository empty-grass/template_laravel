<?php

use Illuminate\Database\Seeder;
use App\Models\Client;

class SampleClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Client::class, 3)->create([
        ]);
    }
}
