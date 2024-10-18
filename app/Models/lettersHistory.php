<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lettersHistory extends Model
{
    use HasFactory;
    protected $table = 'letters_history';
    public $timestamps = false;
    protected $guarded = [];

}
