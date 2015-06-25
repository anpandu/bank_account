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
use App\Models\SocialMedia\InstagramSM;
use App\Exceptions\CrudException;

class InstagramAuthController extends Controller {

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
        $authorize_url = InstagramSM::getAuthorizeURL($url);
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
        $access_token = InstagramSM::mirror(Request::all());
        $access_token = json_decode(json_encode($access_token), true);
        
        $params['user_id'] = $access_token['user']['id'];
        $params['screen_name'] = $access_token['user']['username'];
        $params['image'] = $access_token['user']['profile_picture'];
        $params['social_media'] = 'instagram';
        $params['active'] = true;
        $params['consumer_key'] = Config::get('instagram.connections')['main']['client_id'];
        $params['consumer_secret'] = Config::get('instagram.connections')['main']['client_secret'];
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