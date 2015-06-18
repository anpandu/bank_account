<?php

namespace App\Models\SocialMedia;

use Redirect;
use Config;
use Session;
use App\Models\Account;
use Facebook\FacebookSession;

/**
* FacebookSM adalah class penghubung social media untuk facebook
*
*
*
*/
class FacebookSM {

	public static $app_id = '458102387690960';
	public static $app_secret = '2abfb333b4d8bb91a9d9c7f1540cc937';

	/**
	 * Mengeset App ID dan App Secret
	 * @return void
	 */
	public static function setApp()
	{
		FacebookSession::setDefaultApplication(self::$app_id, self::$app_secret);
	}

	/**
	 * Mendapatkan Authorize URL
	 * @return void
	 */
	public static function getAuthorizeURL($callback_url)
	{
		self::setApp();
		$helper = new MyFacebookRedirectLoginHelper($callback_url);
		$authorize_url = $helper->getLoginUrl();
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
		self::setApp();
		$helper = new MyFacebookRedirectLoginHelper(url('auth_facebook/mirror'));
		$session = $helper->getSessionFromRedirect();
		if ($session) {
			$access_token = $session->getAccessToken();
			$long_access_token = $access_token->extend();
			$user_id = $long_access_token->getInfo()->getId();
			$response = json_decode(file_get_contents("https://graph.facebook.com/me?access_token=" .$long_access_token));
			$result = [
				'access_token' => $long_access_token,
				'user_id' => $user_id,
				'name' => $response->name
			];
			return $result;
		} else
			throw new Exception("No FB Session");
	}

	/**
	* mengecheck validasi akun
	*
	* @param  int  $id
	* @return Response
	*/
	public static function checkAll()
	{
		$accounts = Account::where('social_media', '=', 'facebook')->get();
		foreach ($accounts as $account) {
			$response = json_decode(file_get_contents("https://graph.facebook.com/me?access_token=" .$account->access_token));
			if (isset($response['error'])) {
				$a = Account::where('user_id', '=', $account->user_id)->get()->first();
				$a->active = false;
				$a->save();
			}
		}
		return Redirect::to('gui');
	}

}