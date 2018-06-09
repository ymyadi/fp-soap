<?php

use Illuminate\Database\Seeder;

class Seed_5_AddRecordJabatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Record for `Jabatan`');
        DB::table('jabatan')->insert([
            ['nama' => 'Programmer Web'],
            ['nama' => 'Programmer Mobile'],
			['nama' => 'Tester'],
			['nama' => 'Fullstack Programmer'],
			['nama' => 'Marketing']
        ]);
        $this->command->info('Successfully for `Jabatan`');
    }
}
