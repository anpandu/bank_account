<?php 

namespace App\Http\Controllers;

use Config;
use Route;
use Session;
use Request;
use Redirect;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia\FacebookSM;
use App\Exceptions\CrudException;

class FacebookAuthController extends Controller {

    /**
    * 
    *
    * @return Response
    */
    public function connect()
    {
        $url = Request::get('url');
        if ($url == null)
            throw new \Exception("tak ada param 'url'");
        $authorize_url = FacebookSM::getAuthorizeURL($url);
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
        $access_token = FacebookSM::mirror(Request::all());

        $params['user_id'] = $access_token['user_id'];
        $params['screen_name'] = $access_token['name'];
        $params['social_media'] = 'facebook';
        $params['active'] = true;
        $params['consumer_key'] = FacebookSM::$app_id;
        $params['consumer_secret'] = FacebookSM::$app_secret;
        $params['access_token'] = $access_token['access_token'];
        $params['access_token_secret'] = '';
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