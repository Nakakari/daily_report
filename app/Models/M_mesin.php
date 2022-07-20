<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_mesin extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_mesin', 'serial_number'
    ];
    protected $table = 'tbl_mesin';
    protected $primaryKey = 'id_mesin';
    public $timestamps = false;

    public static function getAll()
    {
        return DB::table('tbl_mesin')
            ->select(
                '*'
            )
            ->get();
    }
}
