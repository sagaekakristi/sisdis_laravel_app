<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'general_note';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
