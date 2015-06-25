<?php

namespace App\Models\SocialMedia;

use Redirect;
use Config;
use Session;
use App\Models\Account;
use Vinkla\Instagram\Facades\Instagram;

/**
* InstagramSM adalah class penghubung social media untuk facebook
*
*
*
*/
class InstagramSM {

	/**
	 * Mendapatkan Authorize URL
	 * @return void
	 */
	public static function getAuthorizeURL($callback_url)
	{
		$authorize_url = Instagram::getLoginUrl();
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
		$data = Instagram::getOAuthToken($params['code']);
		return $data;
	}

	/**
	* mengecheck validasi akun
	*
	* @param  int  $id
	* @return Response
	*/
	public static function checkAll()
	{
		// $accounts = Account::where('social_media', '=', 'facebook')->get();
		// foreach ($accounts as $account) {
		// 	$a = Account::where('user_id', '=', $account->user_id)->get()->first();
		// 	$response = json_decode(file_get_contents("https://graph.facebook.com/me?access_token=" .$account->access_token));
		// 	if (isset($response->error)) {
		// 		$a->active = false;
		// 	} else {
		// 		$name = json_decode(file_get_contents("https://graph.facebook.com/me?access_token=" .$account->access_token))->name;
		// 		$image = json_decode(file_get_contents("https://graph.facebook.com/me/picture?redirect=false&access_token=" .$account->access_token))->data->url;
		// 		$a->screen_name = $name;
		// 		$a->image = $image;
		// 	}
		// 	$a->save();
		// }
		// return Redirect::to('gui');
	}

}