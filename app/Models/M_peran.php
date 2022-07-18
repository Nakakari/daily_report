<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_peran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_peran',
    ];
    protected $table = 'tbl_peran';
    protected $primaryKey = 'id_peran';
    public $timestamps = false;

    public static function getAll()
    {
        return DB::table('tbl_peran')
            ->select(
                '*'
            )
            ->get();
    }
}
