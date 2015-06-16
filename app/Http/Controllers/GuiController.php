<?php 

namespace App\Http\Controllers;

use Request;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Exceptions\CrudException;

class GuiController extends Controller {

    /**
    * Display a listing of the Account.
    *
    * @return Response
    */
    public function index()
    {
        $accounts = Account::all();
        return view('gui.index', ['accounts' => $accounts]);
    }

}

?>