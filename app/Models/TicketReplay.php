<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TicketReplay extends Model
{
    use HasFactory;
    protected $table = 'ticket_replies';
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
