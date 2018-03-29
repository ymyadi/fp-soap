<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mesin = factory(App\Eloquent\Mesin::class, 1)->create();
        $mesinUsers = factory(App\Eloquent\MesinUsers::class, 10)->create();
        $absenLog = factory(App\Eloquent\AbsenLog::class, 200)->create();
    }
}
