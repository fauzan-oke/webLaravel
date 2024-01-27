<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstItem extends Model
{
    use HasFactory;
    protected $table        = 'mst_item';
    protected $guarded      = ['id'];
}
