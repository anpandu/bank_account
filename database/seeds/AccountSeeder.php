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
			'access_token' => '2601075918-HQ1qskrm2bWAxQHZZR8JxURTe3YB5sGePn37Jdq',
            'access_token_secret' => 'vWNxaeRKUBObSb6akqprebqL5KmLh6sGqsds0clE3m4BF',
			'use_count' => '0'
		));
    }
}
