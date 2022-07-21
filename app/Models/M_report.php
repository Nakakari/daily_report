<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_report', 'id_cust', 'id_mesin', 'counter_before', 'counter_after', 'date', 'id_status', 'remarks', 'time_call',
        'time_in', 'time_out', 'notes', 'id_work_for', 'ttd', 'by_aspv', 'by_spv', 'by_asmng', 'by_mng'
    ];
    protected $table = 'tbl_report';
    protected $primaryKey = 'id_report';
    public $timestamps = false;

    public static function getDetail($id_report)
    {
        return DB::table('tbl_report')
            ->join('tbl_customer', 'tbl_customer.id_cust', '=', 'tbl_report.id_cust')
            ->join('tbl_mesin', 'tbl_mesin.id_mesin', '=', 'tbl_report.id_mesin')
            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_report.id_status')
            ->join('users', 'users.id', '=', 'tbl_report.id_work_for')
            ->where('id_report', $id_report)
            ->first();
    }

    public static function ambilproblem($id_report)
    {
        return DB::table('trx_problem')
            ->select(
                'trx_problem.id_report',
                'trx_problem.id_problem',
            )
            ->join('tbl_report', 'tbl_report.id_report', '=', 'trx_problem.id_report')
            ->join('tbl_problem', 'trx_problem.id_problem', '=', 'tbl_problem.id_problem')
            ->where('trx_problem.id_report', $id_report)
            ->get();
    }

    public static function getall()
    {
        return DB::table('tbl_report')
            ->select(
                '*'
            )
            ->join('tbl_customer', 'tbl_customer.id_cust', '=', 'tbl_report.id_cust')
            ->join('tbl_mesin', 'tbl_mesin.id_mesin', '=', 'tbl_report.id_mesin')
            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_report.id_status')
            ->join('users', 'users.id', '=', 'tbl_report.id_work_for')
            ->get();
    }
}
