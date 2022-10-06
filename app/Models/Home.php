<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $table = 'xskt';

    protected $fillable = ['provinces', 'ticket_type', 'date', 'giai', 'result'];
}
