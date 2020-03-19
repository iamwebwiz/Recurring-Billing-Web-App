<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(User::class)->create([
            'email' => 'afrinvest@gmail.com',
            'name' => 'Afrinvest',
        ]);

        $this->command->info('User accounts created successfully.');
    }
}
