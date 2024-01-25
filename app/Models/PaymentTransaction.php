<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $append = ['formatted_date', 'uuid_user'];

    public function getFormattedDateAttribute()
    {
        return getFormattedDate($this->created_at);
    }  

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUuidUserAttribute()
    {
        return $this->user->uuid;
    }
}
