<?php 

namespace App\Http\Controllers;

use Session;
use Request;
use Redirect;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia\TwitterSM;
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
        $facebook_accounts = Account::where('social_media', '=', 'facebook')->get();
        $message = Session::get('message');
        $params = [
            'facebook_accounts' => $facebook_accounts, 
            'twitter_accounts' => $twitter_accounts, 
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

}

?>