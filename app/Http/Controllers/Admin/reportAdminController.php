<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_peran;
use App\Models\M_cust;
use App\Models\M_mesin;
use App\Models\M_report;
use App\Models\M_trxProblem;
use Illuminate\Support\Facades\DB;

class reportAdminController extends Controller
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
        return view('Admin.v_report', $data);
        // dd($data['peran']);
    }

    public function listReport()
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
            'ttd',
            'by_aspv'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_report::select('*')
            ->join('tbl_customer', 'tbl_customer.id_cust', '=', 'tbl_report.id_cust')
            ->join('tbl_mesin', 'tbl_mesin.id_mesin', '=', 'tbl_report.id_mesin')
            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_report.id_status')
            ->orderBy('id_report', "desc");

        $recordsFiltered = $data->get()->count(); //menghitung data yang sudah difilter

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(users.name) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(users.username) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(users.username) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tbl_peran.nama_peran) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
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

    public function hapusReport(Request $request)
    {
        $id_report = $request->get('id_report');
        DB::transaction(
            function () use ($id_report): void {
                DB::table('tbl_report')->whereIn('id_report', array('id_report' => $id_report))->delete();
                DB::table('trx_problem')->whereIn('id_report', array('id_report' => $id_report))->delete();
            }
        );
        return redirect('/report')->with('pesan', 'Data Berhasil Dihapus!');
    }

    public function editReport(Request $request, $id_report)
    {
        $data = [
            'peran' => M_peran::getAll(),
            'customer' => M_cust::getAll(),
            'mesin' => M_mesin::getAll(),
            'problem' => M_cust::getProblem(),
            'status' => M_cust::getStatus(),
            'report' => M_report::getDetail($id_report),
            'problem2' => M_report::ambilproblem($id_report),
            'id_report' => $id_report
        ];
        return view('Teknisi.v_editform', $data);
        // dd($data['problem2']);
    }

    public function updateReport(Request $request, $id_report)
    {
        $id_report = $request->get('id_report');
        $problem = $request->get('problemEdit');

        $file = $request->file('ttd');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'dok_ttd';
        $file->move($tujuan_upload, $nama_file);

        DB::transaction(function () use ($id_report, $problem, $request, $nama_file): void {
            //Update to tbl_problem
            $data = M_report::find(request()->get('id_report'));
            $data->id_cust = $request->get('id_cust');
            $data->id_mesin = $request->get('id_mesin');
            $data->counter_before = $request->get('counter_before');
            $data->counter_after = $request->get('counter_after');
            $data->date = $request->get('date');
            $data->id_status = $request->get('id_status');
            $data->remarks = $request->get('remarks');
            $data->time_call = $request->get('time_call');
            $data->time_in = $request->get('time_in');
            $data->time_out = $request->get('time_out');
            $data->notes = $request->get('notes');
            $data->id_work_for = $request->get('id_work_for');
            $data->ttd = $nama_file;
            // dd($file);

            $data->update();


            // DB::table('tbl_report')->whereIn('id_report', array('id_report' => $id_report))->delete();
            DB::table('trx_problem')->whereIn('id_report', array('id_report' => $id_report))->delete();
            $result = array();
            if (is_array($request->get('problemEdit')) || is_object($request->get('problemEdit'))) {
                foreach ($problem as $key => $val) {
                    $result[] = array(
                        'id_report'   => $id_report,
                        'id_problem'   => $_POST['problemEdit'][$key]
                    );
                }
            }
            //MULTIPLE INSERT TO DETAIL TABLE
            DB::table('trx_problem')->insert($result);
        });
        return redirect('/report')->with('pesan', 'Data Berhasil Dihapus!');
    }

    public function printReport(Request $request, $id_report)
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
            'link' => '/report'
        ];
        return view('v_cetak', $data);
        // dd($data['problem2']);
    }
}
