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
    protected $fillable = ['social_media', 'consumer_key', 'consumer_secret', 'access_token', 'access_token_secret', 'use_count'];

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
}
