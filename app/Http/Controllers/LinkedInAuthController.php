<?php 

namespace App\Http\Controllers;

use Config;
use Route;
use Session;
use Request;
use Redirect;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia\LinkedInSM;
use App\Exceptions\CrudException;

class LinkedInAuthController extends Controller {

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
        $authorize_url = LinkedInSM::getAuthorizeURL($url);
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
        $access_token = LinkedInSM::mirror(Request::all());
        $access_token = json_decode(json_encode($access_token), true);
        
        $params['user_id'] = $access_token['id'];
        $params['screen_name'] = $access_token['firstName'];
        $params['image'] = 'https://pbs.twimg.com/profile_images/3005141692/dc8e1eb36b6cbd2b5726f63c50adf7f2.png';
        $params['social_media'] = 'linkedin';
        $params['active'] = true;
        $params['consumer_key'] = Config::get('oauth-5-laravel.consumers')['Linkedin']['client_id'];
        $params['consumer_secret'] = Config::get('oauth-5-laravel.consumers')['Linkedin']['client_secret'];
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