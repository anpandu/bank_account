<?php

use App\Models\Account;

class AccountCtrlTest extends TestCase {

	private $obj;
	private static $endpoint = 'account';

	public function setUp() 
	{
		parent::setUp();
		$this->obj = $this->setUpObj();
	}

	public function tearDown() 
	{
		$this->obj->delete();
		parent::tearDown();
	}

	private function setUpObj() 
	{
		$obj = new Account;
		$obj->social_media = 'test_social_media';
		$obj->consumer_key = 'test_consumer_key';
		$obj->consumer_secret = 'test_consumer_secret';
		$obj->access_token = 'test_access_token';
		$obj->access_token_secret = 'test_access_token_secret';
		$obj->use_count = 0;
		$obj->save();
		return $obj;
	}

	private function setUpParams() 
	{
		$params = [];
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			if ($attr!='id')
				$params[$attr] = $attr_val;
		return $params;
	}

	public function testIndex()
	{
		// tes pemanggilan index sukses
		$response = $this->call('GET', '/'.self::$endpoint);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent();

		// tes hasil return adalah JSON
		$this->assertTrue($this->isStringJson($result));
		$result_objs = json_decode($result);
		$this->assertTrue(is_array($result_objs));
		$this->assertTrue(count($result_objs)>0);

		// test apakah hasil return adalah yang sesuai
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			$this->assertObjectHasAttribute($attr, $result_objs[0]);
	}

	public function testShow()
	{
		// tes pemanggilan show sukses
		$response = $this->call('GET', '/'.self::$endpoint.'/'.$this->obj->id);
		$this->assertEquals(200, $response->getStatusCode());

		// tes hasil return adalah JSON
		$result = $response->getOriginalContent();
		$this->assertTrue($this->isStringJson($result));
		$result_obj = json_decode($result);

		// test apakah hasil return adalah yang sesuai
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			$this->assertObjectHasAttribute($attr, $result_obj);

		// tes tak ada yang dicari
		$response = $this->call('GET', '/'.self::$endpoint.'/696969');
		$this->assertEquals(500, $response->getStatusCode());
	}

	public function testStore()
	{
		// tes pemanggilan store sukses
		$params = $this->setUpParams();
		$response = $this->call('POST', '/'.self::$endpoint, $params);
		$this->assertEquals(200, $response->getStatusCode());
		
		// tes hasil return adalah JSON
		$result = $response->getOriginalContent();
		$this->assertTrue($this->isStringJson($result));
		$result_obj = json_decode($result);

		// test apakah hasil return adalah yang sesuai
		foreach ($params as $key => $val) {
			$this->assertObjectHasAttribute($key, $result_obj);
			if (isset($key, $result_obj)&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $result_obj->{$key});
		}
	}

	public function testUpdate()
	{
		// tes pemanggilan update sukses
		$params = $this->setUpParams();
		$params['id'] = $this->obj->id.'000';
		$response = $this->call('PUT', '/'.self::$endpoint.'/'.$this->obj->id, $params);
		$this->assertEquals(200, $response->getStatusCode());

		// tes hasil return adalah JSON
		$result = $response->getOriginalContent();
		$this->assertTrue($this->isStringJson($result));

		// test apakah hasil return adalah yang sesuai
		$result_obj = json_decode($result);
		foreach ($params as $key => $val) {
			$this->assertObjectHasAttribute($key, $result_obj);
			if (isset($key, $result_obj)&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $result_obj->{$key});
		}

		// tes tak ada yang dicari
		$response = $this->call('GET', '/'.self::$endpoint.'/696969', $params);
		$this->assertEquals(500, $response->getStatusCode());
	}

	public function testDelete()
	{
		// tes pemanggilan delete sukses
		$obj2 = $this->setUpObj();
		$response = $this->call('DELETE', '/'.self::$endpoint.'/'.$obj2->id);
		$this->assertEquals(200, $response->getStatusCode());

		// tes hasil return adalah JSON
		$result = $response->getOriginalContent();
		$this->assertTrue($this->isStringJson($result));

		// test apakah udah terdelete di db
		$result_obj = json_decode($result);
		$response = $this->call('GET', '/'.self::$endpoint.'/'.$obj2->id);
		$this->assertEquals(500, $response->getStatusCode());

		// test apakah hasil return adalah yang sesuai
		foreach ($obj2->attributesToArray() as $key => $val) {
			$this->assertObjectHasAttribute($key, $result_obj);
			if (isset($key, $result_obj)&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $result_obj->{$key});
		}
	}

	public function testUse()
	{
		// tes pemanggilan use sukses
		$use_count = $this->obj->use_count;
		$response = $this->call('GET', '/'.self::$endpoint.'/use/'.$this->obj->id);
		$this->assertEquals(200, $response->getStatusCode());

		// tes hasil return adalah JSON
		$result = $response->getOriginalContent();
		$this->assertTrue($this->isStringJson($result));
		$obj2 = json_decode($result, true);

		foreach ($obj2 as $key => $val) {
			if ($key=='use_count')
				$this->assertEquals($val, $use_count+1);
			else
			if (isset($key, $this->obj)&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $this->obj->{$key});
		}
	}

	public function testCancel()
	{
		// tes pemanggilan cancel sukses
		$use_count = $this->obj->use_count;
		$response = $this->call('GET', '/'.self::$endpoint.'/cancel/'.$this->obj->id);
		$this->assertEquals(200, $response->getStatusCode());

		// tes hasil return adalah JSON
		$result = $response->getOriginalContent();
		$this->assertTrue($this->isStringJson($result));
		$obj2 = json_decode($result, true);

		foreach ($obj2 as $key => $val) {
			if ($key=='use_count')
				$this->assertEquals($val, $use_count-1);
			else
			if (isset($key, $this->obj)&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $this->obj->{$key});
		}
	}

}
