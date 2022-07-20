<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_peran;
use App\Models\M_mesin;
use Illuminate\Support\Facades\DB;

class MasterDataMesinController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        // $peran = M_peran::getAll();
        return view('Admin.v_masterdataMesin', $data);
        // dd($data['peran']);
    }

    public function listMesin()
    {
        $columns = [
            'id_mesin',
            'model_mesin',
            'serial_number',
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_mesin::select('*')
            ->orderBy('id_mesin', "desc");;

        $recordsFiltered = $data->get()->count(); //menghitung data yang sudah difilter

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(tbl_mesin.model_mesin) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tbl_mesin.serial_number) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
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

    public function addMesin(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'model_mesin' => ['required', 'string', 'max:255'],
            'serial_number' => ['required', 'string', 'max:255'],
        ]);

        $data = new M_mesin();
        $data->model_mesin = $request->get('model_mesin');
        $data->serial_number = $request->get('serial_number');
        // dd($file);

        $data->save();
        $data->id_mesin;

        return redirect()->back()->with('pesan', 'Data Berhasil Ditambah!');
    }

    public function editMesin(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'model_mesin' => ['required', 'string', 'max:255'],
            'serial_number' => ['required', 'string', 'max:255'],
        ]);

        $data =  M_mesin::find(request()->get('id_mesin'));
        $data->model_mesin = $request->get('model_mesin');
        $data->serial_number = $request->get('serial_number');
        // dd($file);

        $data->update();

        return redirect()->back()->with('pesan', 'Data Berhasil Diupdate!!');
    }

    public function hapusMesin()
    {
        DB::table('tbl_mesin')->where('id_mesin', request()->get('id_mesin'))->delete();
        return redirect()->back()->with('pesan', 'Data Berhasil Dihapus!');
    }
}
