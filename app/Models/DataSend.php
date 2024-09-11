<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSend extends Model
{
    use \Illuminate\Notifications\Notifiable; 
    protected $table = 'datas';
    public $timestamps = false;
}
