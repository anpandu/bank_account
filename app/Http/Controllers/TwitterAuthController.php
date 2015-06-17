<?php 

namespace App\Http\Controllers;

use Config;
use Route;
use Session;
use Request;
use Redirect;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia\TwitterSM;
use App\Exceptions\CrudException;

class TwitterAuthController extends Controller {

    /**
    * 
    *
    * @return Response
    */
    public function connect()
    {
        $url = Request::get('url');
        $base_url = Request::get('base_url');
        if ($url == null)
            throw new \Exception("tak ada param 'url'");
        $authorize_url = TwitterSM::getAuthorizeURL($url, $base_url);
        return Redirect::to($authorize_url);
    }

    /**
    * memantulkan hasil sign in ke front-end
    *
    * @param  int  $id
    * @return Response
    */
    public function mirror()
    {
        $p = Request::all();

        $access_token = TwitterSM::mirror($p);

        $params['user_id'] = $access_token['user_id'];
        $params['screen_name'] = $access_token['screen_name'];
        $params['social_media'] = 'twitter';
        $params['active'] = true;
        $params['consumer_key'] = Config::get('ttwitter.CONSUMER_KEY');
        $params['consumer_secret'] = Config::get('ttwitter.CONSUMER_SECRET');
        $params['access_token'] = $access_token['oauth_token'];
        $params['access_token_secret'] = $access_token['oauth_token_secret'];
        $params['_redirect'] = 'gui';

        try {
            $account = new Account($params);
            if ($account->save()) {
                if (isset($params['_redirect']))
                    return redirect($params['_redirect']);
                return $account;
            } else
                throw new CrudException('account:store');
        } catch (\Exception $e) {
            return redirect('gui')->with(['message' => 'akun yang anda masukkan sudah ada']);
        }
    }

}

?>