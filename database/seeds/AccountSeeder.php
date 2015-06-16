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
            'social_media' => 'twitter',
            'consumer_key' => 'Dsmj7TH879HnWAA6n4aug',
            'consumer_secret' => 'Wya4BuwIjGn5MJLbYcH3FqGjJhUmo63eSAu1jZ4fZk',
            'access_token' => 'kyakyakyakyakya',
            'access_token_secret' => 'kyakyakyakyakya',
            'use_count' => '0'
        ));
        Account::create(array(
            'social_media' => 'twitter',
            'consumer_key' => 'Dsmj7TH879HnWAA6n4aug',
            'consumer_secret' => 'Wya4BuwIjGn5MJLbYcH3FqGjJhUmo63eSAu1jZ4fZk',
            'access_token' => 'qweqweqweqweqwe',
            'access_token_secret' => 'qweqweqweqweqwe',
            'use_count' => '0'
        ));
        Account::create(array(
            'social_media' => 'twitter',
            'consumer_key' => 'Dsmj7TH879HnWAA6n4aug',
            'consumer_secret' => 'Wya4BuwIjGn5MJLbYcH3FqGjJhUmo63eSAu1jZ4fZk',
            'access_token' => 'asdasdasdasdasd',
            'access_token_secret' => 'asdasdasdasdasd',
            'use_count' => '0'
        ));
        Account::create(array(
            'social_media' => 'twitter',
            'consumer_key' => 'Dsmj7TH879HnWAA6n4aug',
            'consumer_secret' => 'Wya4BuwIjGn5MJLbYcH3FqGjJhUmo63eSAu1jZ4fZk',
            'access_token' => 'zxczxczxczxczxc',
            'access_token_secret' => 'zxczxczxczxczxc',
            'use_count' => '0'
        ));
        Account::create(array(
            'social_media' => 'twitter',
            'consumer_key' => 'Dsmj7TH879HnWAA6n4aug',
            'consumer_secret' => 'Wya4BuwIjGn5MJLbYcH3FqGjJhUmo63eSAu1jZ4fZk',
            'access_token' => '123123123123123',
            'access_token_secret' => '123123123123123',
            'use_count' => '0'
        ));
    }
}
