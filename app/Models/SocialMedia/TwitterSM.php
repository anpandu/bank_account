<?php

namespace App\Models\SocialMedia;

use Redirect;
use Config;
use Twitter;
use Session;
use App\Models\Account;

/**
* TwitterSM adalah class penghubung social media untuk twitter
*
*
*
*/
class TwitterSM {

	private static $default_access_token = '2601075918-HQ1qskrm2bWAxQHZZR8JxURTe3YB5sGePn37Jdq';
	private static $default_access_token_secret = 'vWNxaeRKUBObSb6akqprebqL5KmLh6sGqsds0clE3m4BF';

	/**
	 * Mengeset Access Token
	 * @return void
	 */
	public static function _applyAccessToken()
	{
		Config::set('ttwitter.ACCESS_TOKEN', self::$default_access_token);
		Config::set('ttwitter.ACCESS_TOKEN_SECRET', self::$default_access_token_secret);
	}

	/**
	 * Mengeset Access Token
	 * @return void
	 */
	public static function setAccessToken($at, $atk)
	{
		self::$default_access_token = $at;
		self::$default_access_token_secret = $atk;
	}

	/**
	 * Mendapatkan Authorize URL
	 * @return void
	 */
	public static function getAuthorizeURL($callback_url, $base_url)
	{
		$request_token = Twitter::getRequestToken($callback_url);
		Session::put(['reqtok' => $request_token]);
		Session::put(['base_url' => $base_url]);
		$authorize_url = Twitter::getAuthorizeURL($request_token, true, true);
		return $authorize_url;
	}

	/**
	* memantulkan hasil sign in ke front-end
	*
	* @param  int  $id
	* @return Response
	*/
	public static function mirror($params)
	{
		$reqtok = Session::get('reqtok');

		Config::set('ttwitter.ACCESS_TOKEN', $reqtok['oauth_token']);
		Config::set('ttwitter.ACCESS_TOKEN_SECRET', $reqtok['oauth_token_secret']);

		$result = Twitter::getAccessToken($params['oauth_verifier']);
		
		return $result;
	}

	/**
	* mengecheck validasi akun
	*
	* @param  int  $id
	* @return Response
	*/
	public static function checkAll()
	{
		$accounts = Account::all();
		foreach ($accounts as $account) {
			$conf = [
				'token' => $account->access_token,
				'secret' => $account->access_token_secret
			];
			Twitter::reconfig($conf);
			try {
				$profile = Twitter::query('account/verify_credentials', 'GET');
			} catch (\Exception $e) {
				$a = Account::where('user_id', '=', $account->user_id)->get()->first();
				$a->active = false;
				$a->save();
			}
		}
		return Redirect::to('gui');
	}

}