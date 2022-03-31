<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $this->call([
                SampleUserSeeder::class,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            print_r("ERROR!".$e->getMessage().':'.$e->getLine()."\n");
        }
    }
}
