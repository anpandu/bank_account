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
		$accounts = Account::where('social_media', '=', 'instagram')->get();
		foreach ($accounts as $account) {
			$a = Account::where('user_id', '=', $account->user_id)->get()->first();
			Instagram::setAccessToken($account->access_token);
			$data = Instagram::getUser();
			
			if ($data->meta->code!==200) {
				$a->active = false;
			} else {
				$a->screen_name = $data->data->username;
				$a->image = $data->data->profile_picture;
			}
			$a->save();
		}
		return Redirect::to('gui');
	}

}