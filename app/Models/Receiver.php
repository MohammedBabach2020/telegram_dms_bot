<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use \Illuminate\Notifications\Notifiable; 
    use HasFactory;
    protected $fillable = ['chat_id','name'];
    public $timestamps = false;
}
