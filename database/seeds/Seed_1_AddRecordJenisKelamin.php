<?php

use Illuminate\Database\Seeder;

class Seed_1_AddRecordJenisKelamin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Record for `Jenis Kelamin`');
        DB::table('jenis_kelamin')->insert([
            ['nama' => 'Laki-laki'],
            ['nama' => 'Perempuan']
        ]);
        $this->command->info('Successfully for `Jenis Kelamin`');
    }
}
