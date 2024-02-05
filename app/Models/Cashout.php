<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashout extends Model
{
    use HasFactory;

    protected $append = ['formatted_date', 'uuid_user'];

    public function getFormattedDateAttribute()
    {
        return getFormattedDate($this->created_at);
    }  

    public function getUuidUserAttribute()
    {
        return User::where('openid', $this->uuid)->first()->name;
    }
}
