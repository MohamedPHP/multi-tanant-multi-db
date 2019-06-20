<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Company;
use App\Events\TanantWasCreated;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'mohamed',
            'email' => 'mohamedzayed709@yahoo.com',
            'password' => Hash::make('mohamedzayed709@yahoo.com'),
        ]);

        $company = Company::create([
            'name' => 'Uflare'
        ]);


        $company->users()->attach($user);

        event(new TanantWasCreated($company));
    }
}
