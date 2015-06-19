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
		$result['image'] = Twitter::query('account/verify_credentials', 'GET')->profile_image_url;
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
		$accounts = Account::where('social_media', '=', 'twitter')->get();
		foreach ($accounts as $account) {
			$conf = [
				'token' => $account->access_token,
				'secret' => $account->access_token_secret
			];
			Twitter::reconfig($conf);

			$a = Account::where('user_id', '=', $account->user_id)->get()->first();
			try {
				$profile = Twitter::query('account/verify_credentials', 'GET');
				$a->screen_name = $profile->screen_name;
				$a->image = $profile->profile_image_url;
			} catch (\Exception $e) {
				$a->active = false;
			}
			$a->save();
		}
		return Redirect::to('gui');
	}

}