<?php 

namespace App\Http\Controllers;

use Request;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Exceptions\CrudException;

class AccountController extends Controller {

    /**
    * Display a listing of the Account.
    *
    * @return Response
    */
    public function index()
    {
        $accounts = Account::all();
        return $accounts;
    }

    /**
    * Show the form for creating a new Account.
    *
    * @return Response
    */
    public function create()
    {

    }

    /**
    * Store a newly created Account in storage.
    *
    * @return Response
    */
    public function store()
    {
        $account = new Account(Request::all());
        if ($account->save()) {
            $params = Request::all();
            if (isset($params['_redirect']))
                return redirect($params['_redirect']);
            return $account;
        } else
        throw new CrudException('account:store');
    }

    /**
    * Display the specified Account.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $account = Account::find($id);
        if ($account) {
            return $account; 
        } else
        throw new CrudException('account:show');
    }

    /**
    * Show the form for editing the specified Account.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

    }

    /**
    * Update the specified Account in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $account = Account::find($id);
        if ($account) {
            foreach (Request::all() as $key => $value)
                $account->{$key} = $value;
            if ($account->save())
                return $account;
        }
        throw new CrudException('account:update');
    }

    /**
    * Remove the specified Account from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $account = Account::find($id);
        if ($account) {
            $account->delete();
            $params = Request::all();
            if (isset($params['_redirect']))
                return redirect($params['_redirect']);
            return $account;
        }
        throw new CrudException('account:destroy');
    }

    /**
    * 
    *
    * @param  int  $id
    * @return Response
    */
    public function use_one($id)
    {
        $acc = Account::find($id);
        $result = $acc->useOne();
        return $result;
    }

    /**
    * 
    *
    * @param  int  $id
    * @return Response
    */
    public function cancel($id)
    {
        $acc = Account::find($id);
        $result = $acc->cancel();
        return $result;
    }

    /**
    * 
    *
    * @param  int  $id
    * @return Response
    */
    public function fastuse()
    {
        $acc = Account::findAvailable('twitter');
        $result = $acc->useOne();
        return $result;
    }

}

?>