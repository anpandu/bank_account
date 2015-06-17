<?php

use App\Models\Account;


/**
 * Tes model Account
 */
class AccountTest extends TestCase {

	/**
	 * Setup Environtment dan database.
	 */
	public function setUp()
	{
		parent::setUp();
	}

	/**
	 * Tes menambahkan Account
	 */
	public function testAdd()
	{
		$acc = new Account;
		$acc->user_id = rand(0, 10000000);
		$acc->screen_name = 'test_screen_name';
		$acc->social_media = 'test_social_media';
		$acc->consumer_key = 'test_consumer_key';
		$acc->consumer_secret = 'test_consumer_secret';
		$acc->access_token = 'test_access_token';
		$acc->access_token_secret = 'test_access_token_secret';
		$acc->use_count = 0;
		$saved = $acc->save();

		$this->assertTrue($saved);

		$acc_2 = Account::find($acc->id);
		if ($acc_2 !== null) {
			$this->assertEquals($acc, $acc_2);
		}
	}

	/**
	 * Tes memakai Account
	 */
	public function testUseOne()
	{
		$acc = new Account;
		$acc->use_count = 0;
		$saved = $acc->save();
		$this->assertTrue($saved);

		$use_count = $acc->use_count;
		$acc2 = $acc->useOne();
		foreach ($acc2->attributesToArray() as $key => $val) {
			if ($key=='use_count')
				$this->assertEquals($val, $use_count+1);
			else
			if (isset($key, $acc)&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $acc->{$key});
		}
	}

	/**
	 * Tes membatalkan Account
	 */
	public function testCancel()
	{
		$acc = new Account;
		$acc->use_count = 0;
		$saved = $acc->save();
		$this->assertTrue($saved);

		$use_count = $acc->use_count;
		$acc2 = $acc->cancel();
		foreach ($acc2->attributesToArray() as $key => $val) {
			if ($key=='use_count')
				$this->assertEquals($val, $use_count-1);
			else
			if (isset($key, $acc)&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $acc->{$key});
		}
	}

	/**
	 * Tes memakai Account
	 */
	public function testFindAvailable()
	{
		for ($i=0; $i < 5; $i++) { 
			$acc = new Account;
			$acc->user_id = rand(0, 10000000);
			$acc->use_count = $i;
			$saved = $acc->save();
			$this->assertTrue($saved);
		}

		$acc2 = Account::findAvailable();
		$this->assertEquals(0, $acc2->use_count);
	}

}
