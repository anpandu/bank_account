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
        $accounts = Account::all();
        $message = Session::get('message');
        return view('gui.index', ['accounts' => $accounts, 'message' => $message]);
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