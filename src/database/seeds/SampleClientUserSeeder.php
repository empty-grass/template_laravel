<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientUser;

class SampleClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $clients = Client::get();

        foreach ($clients as $client) {
            $random_users = $users->random(2);

            foreach ($random_users as $user) {
                ClientUser::create([
                    'client_id' => $client->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
