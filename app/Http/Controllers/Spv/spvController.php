<?php

namespace App\Http\Controllers\Spv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_peran;
use App\Models\M_cust;
use App\Models\M_mesin;
use App\Models\M_report;
use App\Models\M_trxProblem;
use Illuminate\Support\Facades\DB;

class spvController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'peran' => M_peran::getAll(),
            'customer' => M_cust::getAll(),
            'mesin' => M_mesin::getAll(),
            'problem' => M_cust::getProblem(),
            'status' => M_cust::getStatus(),
            'report' => M_report::getall(),
        ];
        // $peran = M_peran::getAll();
        return view('Spv.v_spv', $data);
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
            ->where('tbl_report.by_aspv', 1)
            ->where('tbl_report.by_asmng', 0)
            ->orwhere('tbl_report.by_asmng', 1)
            ->orwhere('tbl_report.by_asmng', 2)
            ->orwhere('tbl_report.by_asmng', 3)
            ->where('tbl_report.by_mng', 0)
            ->orwhere('tbl_report.by_mng', 1)
            ->orwhere('tbl_report.by_mng', 2)
            ->orwhere('tbl_report.by_mng', 3)
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
        $report->by_spv = $request->by_spv;
        $report->save();
        return response()->json(true);
    }

    public function revisionByAspv(Request $request)
    {
        $report = M_report::find($request->input('id_report'));
        $report->by_spv = $request->by_spv;
        $report->save();
        return response()->json(true);
    }

    public function rejectByAspv(Request $request)
    {
        $report = M_report::find($request->input('id_report'));
        $report->by_spv = $request->by_spv;
        $report->save();
        return response()->json(true);
    }

    public function detailProblem()
    {
        $item =  M_report::ambilproblem(request()->input('id_report'));
        return $item;
    }

    public function detail(Request $request, $id_report)
    {
        $data = [
            'peran' => M_peran::getAll(),
            'customer' => M_cust::getAll(),
            'mesin' => M_mesin::getAll(),
            'problem' => M_cust::getProblem(),
            'status' => M_cust::getStatus(),
            'r' => M_report::getDetail($id_report),
            'problem2' => M_report::ambilproblem($id_report),
            'id_report' => $id_report,
            'link' => '/daftar_reportSpv'
        ];
        return view('Teknisi.v_detail', $data);
        // dd($data['problem2']);
    }
}
