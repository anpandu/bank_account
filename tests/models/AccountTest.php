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
		$obj = new Account;
		$obj->social_media = 'test_social_media';
		$obj->consumer_key = 'test_consumer_key';
		$obj->consumer_secret = 'test_consumer_secret';
		$obj->access_token = 'test_access_token';
		$obj->access_token_secret = 'test_access_token_secret';
		$saved = $obj->save();

		$this->assertTrue($saved);
		if ($saved) {
			$obj_2 = Account::find($obj->id);
			if ($obj_2 !== null) {
				$this->assertEquals($obj, $obj_2);
			}
		}
	}

}
