<?php

use Illuminate\Database\Seeder;

class Seed_4_AddUsersAdministrator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Record `User Administrator`');
        $username = 'admin.attendance@local.dev';
        $password = 'admin1234';
        DB::table('users')->insert([
            [
                'user_id' => 1,
                'name' => 'Administrator',
                'email' => $username,
                'password' => bcrypt($password)
            ]
        ]);
        $this->command->info('Successfully creating record `User Administrator`');
        $this->command->info('Username : ' . $username);
        $this->command->info('Password : ' . $password);
    }
}
