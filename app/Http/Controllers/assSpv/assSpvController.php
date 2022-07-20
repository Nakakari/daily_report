<?php

namespace App\Http\Controllers\assSpv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_peran;
use App\Models\M_cust;
use App\Models\M_mesin;
use App\Models\M_report;
use App\Models\M_trxProblem;
use Illuminate\Support\Facades\DB;

class assSpvController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        // $peran = M_peran::getAll();
        return view('assSpv.v_assSpv', $data);
        // dd($data['peran']);
    }

    public function listReportAspv()
    {
        $columns = [
            'id_report',
            'tbl_report.id_cust',
            'id_mesin',
            'counter_before',
            'counter_after',
            'date',
            'id_status',
            'remarks',
            'time_call',
            'time_in',
            'time_out',
            'notes',
            'ttd'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_report::select('*')
            ->join('tbl_customer', 'tbl_customer.id_cust', '=', 'tbl_report.id_cust')
            ->join('tbl_mesin', 'tbl_mesin.id_mesin', '=', 'tbl_report.id_mesin')
            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_report.id_status')
            ->join('users', 'users.id', '=', 'tbl_report.id_work_for')
            ->where('tbl_report.by_spv', null)
            ->where('tbl_report.by_asmng', null)
            ->where('tbl_report.by_mng', null)
            ->orderBy('id_report', "desc");

        $recordsFiltered = $data->get()->count(); //menghitung data yang sudah difilter

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(tbl_report.date) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tbl_mesin.model_mesin) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(users.name) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tbl_status.nama_status) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
            });
        }

        $data = $data
            ->skip(request()->input('start'))
            ->take(request()->input('length'))
            ->orderBy($orderBy, request()->input("order.0.dir"))
            ->get();
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'all_request' => request()->all()
        ]);
    }

    public function approveByAspv(Request $request)
    {
        $report = M_report::find($request->input('id_report'));
        $report->by_aspv = $request->by_aspv;
        $report->save();
        return response()->json(true);
    }

    public function revisionByAspv(Request $request)
    {
        $report = M_report::find($request->input('id_report'));
        $report->by_aspv = $request->by_aspv;
        $report->save();
        return response()->json(true);
    }

    public function rejectByAspv(Request $request)
    {
        $report = M_report::find($request->input('id_report'));
        $report->by_aspv = $request->by_aspv;
        $report->save();
        return response()->json(true);
    }
}
