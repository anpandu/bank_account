<?php 

namespace App\Http\Controllers;

use Session;
use Request;
use Redirect;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia\TwitterSM;
use App\Models\SocialMedia\LinkedInSM;
use App\Models\SocialMedia\FacebookSM;
use App\Models\SocialMedia\InstagramSM;
use App\Models\SocialMedia\GooglePlusSM;
use App\Exceptions\CrudException;

class GuiController extends Controller {

    /**
    * 
    *
    * @return Response
    */
    public function index()
    {
        $twitter_accounts = Account::where('social_media', '=', 'twitter')->get();
        $linkedin_accounts = Account::where('social_media', '=', 'linkedin')->get();
        $facebook_accounts = Account::where('social_media', '=', 'facebook')->get();
        $instagram_accounts = Account::where('social_media', '=', 'instagram')->get();
        $googleplus_accounts = Account::where('social_media', '=', 'googleplus')->get();
        $message = Session::get('message');
        $params = [
            'twitter_accounts' => $twitter_accounts, 
            'linkedin_accounts' => $linkedin_accounts, 
            'facebook_accounts' => $facebook_accounts, 
            'instagram_accounts' => $instagram_accounts, 
            'googleplus_accounts' => $googleplus_accounts, 
            'message' => $message
        ];
        return view('gui.index', $params);
    }

    /**
    * 
    *
    * @return Response
    */
    public function create()
    {
        return view('gui.create');
    }

    /**
    * 
    *
    * @return Response
    */
    public function check()
    {
        TwitterSM::checkAll();
        LinkedInSM::checkAll();
        FacebookSM::checkAll();
        InstagramSM::checkAll();
        GooglePlusSM::checkAll();
        return Redirect::to('gui');
    }

}

?>