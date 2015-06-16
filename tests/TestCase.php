<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

	public function cetak($value)
	{
		fwrite(STDERR, print_r($value, TRUE));
	}

	/**
	 * Setup Environtment dan database.
	 */
	public function setUp()
	{
		parent::setUp();
		$this->app['config']->set('database.default','mysql_testing'); 
	    self::artisan('migrate:refresh', ['--database' => 'mysql_testing']);
	}

	public static function isStringJson($string) {
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}
