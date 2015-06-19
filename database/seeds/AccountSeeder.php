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
            'image' => 'http://orig15.deviantart.net/0a6a/f/2012/024/2/4/super_kawaii_desu_desu_ne_nicolas_cage_by_oosterific-d4nhlp8.jpg',
            'social_media' => 'twitter',
            'active' => true,
            'consumer_key' => 'Dsmj7TH879HnWAA6n4aug',
            'consumer_secret' => 'Wya4BuwIjGn5MJLbYcH3FqGjJhUmo63eSAu1jZ4fZk',
            'access_token' => 'kyakyakyakyakya',
            'access_token_secret' => 'kyakyakyakyakya',
            'use_count' => '0'
        ));
    }
}
