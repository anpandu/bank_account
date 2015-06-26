<?php

namespace App\Models\SocialMedia;

use Redirect;
use Config;
use Session;
use OAuth;
use App\Models\Account;
use OAuth\OAuth2\Token\StdOAuth2Token;

/**
* GooglePlusSM adalah class penghubung social media untuk facebook
*
*
*
*/
class GooglePlusSM {

	/**
	 * Mendapatkan Authorize URL
	 * @return void
	 */
	public static function getAuthorizeURL($callback_url)
	{
		$google_service = OAuth::consumer('Google');
		$authorize_url = $google_service->getAuthorizationUri();
		$queries = []; 
		parse_str($authorize_url->getQuery(), $queries);
		$queries['redirect_uri'] = $callback_url;
		$authorize_url->setQuery(http_build_query($queries));
		return $authorize_url->getAbsoluteUri();
	}

	/**
	* memantulkan hasil sign in ke front-end
	*
	* @param  int  $id
	* @return Response
	*/
	public static function mirror($params)
	{
		$code = $params['code'];
    	$google_service = OAuth::consumer('Google');
        $token = $google_service->requestAccessToken($code);
        $result = json_decode($google_service->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);
        $result['access_token'] = $token->getAccessToken();
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
		$accounts = Account::where('social_media', '=', 'googleplus')->get();
		foreach ($accounts as $account) {
			$a = Account::where('user_id', '=', $account->user_id)->get()->first();
			$token = $a->access_token;
			$token_interface = new StdOAuth2Token($token);

    		$google_service = OAuth::consumer('Google');
			$google_service->getStorage()->storeAccessToken($google_service->service(), $token_interface);
			
			$response = json_decode(@file_get_contents('https://www.googleapis.com/oauth2/v1/tokeninfo?access_token='.$token));			

			if ($response==null||isset($response->error)) {
				$a->active = false;
			} else {
				$data = json_decode($google_service->request('https://www.googleapis.com/oauth2/v1/userinfo'));
				$a->screen_name = $data->name;
				$a->image = $data->picture;
			}
			$a->save();
		}
		return Redirect::to('gui');
	}

}