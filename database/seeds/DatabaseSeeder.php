<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Seed_1_AddRecordJenisKelamin::class);
        $this->call(Seed_2_AddRecordPegawaiStatus::class);
        $this->call(Seed_3_AddRecordStatusAbsenLog::class);
        $this->call(Seed_4_AddUsersAdministrator::class);
    }
}
