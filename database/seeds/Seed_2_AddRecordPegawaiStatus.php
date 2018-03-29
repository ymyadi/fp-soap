<?php

use Illuminate\Database\Seeder;

class Seed_2_AddRecordPegawaiStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Record for `Status Pegawai`');
        DB::table('pegawai_status')->insert([
            ['nama' => 'Aktif'],
            ['nama' => 'Tidak Aktif']
        ]);
        $this->command->info('Successfully creating record for `Status Pegawai`');
    }
}
