<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_trxProblem extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_report', 'id_problem'
    ];
    protected $table = 'trx_problem';
    protected $primaryKey = 'id_trx_problem';
    public $timestamps = false;
}
