<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['plan_id', 'status', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
