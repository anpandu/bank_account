<?php

namespace App\Models\SocialMedia;

use Redirect;
use Config;
use Session;
use OAuth;
use App\Models\Account;
use OAuth\OAuth2\Token\StdOAuth2Token;

/**
* LinkedInSM adalah class penghubung social media untuk Linked In
*
*
*
*/
class LinkedInSM {

	/**
	 * Mendapatkan Authorize URL
	 * @return void
	 */
	public static function getAuthorizeURL($callback_url)
	{
		$linkedin_service = OAuth::consumer('Linkedin');
		$authorize_url = $linkedin_service->getAuthorizationUri();
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
    	$linkedin_service = OAuth::consumer('Linkedin');
        $token = $linkedin_service->requestAccessToken($code);
        $result = json_decode($linkedin_service->request('https://api.linkedin.com/v1/people/~?format=json'), true);
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
		$accounts = Account::where('social_media', '=', 'linkedin')->get();
		foreach ($accounts as $account) {
			$a = Account::where('user_id', '=', $account->user_id)->get()->first();
			$token = $a->access_token;
			$token_interface = new StdOAuth2Token($token);

    		$linkedin_service = OAuth::consumer('Linkedin');
			$linkedin_service->getStorage()->storeAccessToken($linkedin_service->service(), $token_interface);

			try {
				$response = json_decode($linkedin_service->request('https://api.linkedin.com/v1/people/~?format=json'), true);
				$data = json_decode($linkedin_service->request('https://api.linkedin.com/v1/people/~?format=json'), true);
				$a->screen_name = $data['firstName'];
			} catch (\Exception $e) {
				$a->active = false;
			}

			$a->save();
		}
		return Redirect::to('gui');
	}

}