<?php

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create(array(
            'user_id' => '111',
            'screen_name' => 'kya',
            'social_media' => 'twitter',
            'consumer_key' => 'Dsmj7TH879HnWAA6n4aug',
            'consumer_secret' => 'Wya4BuwIjGn5MJLbYcH3FqGjJhUmo63eSAu1jZ4fZk',
            'access_token' => 'kyakyakyakyakya',
            'access_token_secret' => 'kyakyakyakyakya',
            'use_count' => '0'
        ));
    }
}
