<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDetail;
use App\Models\Priority;
use App\Models\Service;
use App\Models\User;
use App\Models\Category;
use App\Models\TicketReply;
class Ticket extends Model
{
    use HasFactory;
    public function service()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function priority()
    {
        return $this->hasOne(Priority::class,'id','priority_id');
    }

    public function customer()
    {
        return $this->hasOne(User::class,'id','customer_id');
    }

    public function lastReply()
    {
        return $this->hasOne(User::class,'id','last_replay_by');
    }

    public function comments()
    {
        return $this->hasMany(TicketReplay::class);
    }
}
