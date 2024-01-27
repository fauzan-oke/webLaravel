<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxKoperasi extends Model
{
    use HasFactory;
    protected $table        = 'trx_koperasi';
    protected $guarded      = ['id'];
}
