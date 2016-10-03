<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorCount extends Model
{
    protected $table = 'visitor_count';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
