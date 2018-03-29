<?php

use Illuminate\Database\Seeder;

class Seed_3_AddRecordStatusAbsenLog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Record for `Status Absen Log`');
        DB::table('status_absen')->insert([
            ['nama' => 'Processed'],
            ['nama' => 'Unprocessed']
        ]);
        $this->command->info('Successfully creating record for `Status Absen Log`');
    }
}
