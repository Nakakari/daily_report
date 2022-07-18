<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_jk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jk',
    ];
    protected $table = 'tbl_jk';
    protected $primaryKey = 'id_jk';
    public $timestamps = false;
}
