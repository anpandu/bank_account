<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'screen_name', 'social_media', 'active', 'consumer_key', 'consumer_secret', 'access_token', 'access_token_secret', 'use_count'];

    public function useOne()
    {
        $this->use_count += 1;
        $this->save();
        return $this;
    }

    public function cancel()
    {
        $this->use_count -= 1;
        $this->save();
        return $this;
    }

    public static function findAvailable($social_media)
    {
        $accounts = Account::where('active', '=', '1')->where('social_media', '=', $social_media)->get();
        $accounts->sortBy(function($x){
            return $x->use_count;
        });
        $a = $accounts->first();
        return $a;
    }
}
