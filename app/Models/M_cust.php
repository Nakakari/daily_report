<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_cust extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_cust', 'alamat_cust', 'option_cust'
    ];
    protected $table = 'tbl_customer';
    protected $primaryKey = 'id_cust';
    public $timestamps = false;

    public static function getAll()
    {
        return DB::table('tbl_customer')
            ->select(
                '*'
            )
            ->get();
    }

    public static function getProblem()
    {
        return DB::table('tbl_problem')
            ->select(
                '*'
            )
            ->get();
    }

    public static function getStatus()
    {
        return DB::table('tbl_status')
            ->select(
                '*'
            )
            ->get();
    }
}
