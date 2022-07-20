<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\M_peran;
use App\Models\M_jk;
use App\Models\M_cust;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterDataCustomerController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        // $peran = M_peran::getAll();
        return view('Admin.v_masterdataCustomer', $data);
        // dd($data['peran']);
    }

    public function listCust()
    {
        $columns = [
            'id_cust',
            'nama_cust',
            'alamat_cust',
            'option_cust'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_cust::select('*')
            ->orderBy('id_cust', "desc");;

        $recordsFiltered = $data->get()->count(); //menghitung data yang sudah difilter

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(tbl_customer.nama_cust) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tbl_customer.alamat_cust) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tbl_customer.option_cust) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
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

    public function addCust(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'nama_cust' => ['required', 'string', 'max:255'],
            'option_cust' => ['required', 'unique:tbl_customer'],
            "alamat_cust" => ['required', 'string', 'max:255'],
        ]);

        $data = new M_cust();
        $data->nama_cust = $request->get('nama_cust');
        $data->option_cust = $request->get('option_cust');
        $data->alamat_cust = $request->get('alamat_cust');
        // dd($file);

        $data->save();

        return redirect()->back()->with('pesan', 'Data Berhasil Ditambah!!');
    }

    public function editCust(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'nama_cust' => ['required', 'string', 'max:255'],
            'option_cust' => ['required'],
            "alamat_cust" => ['required', 'string', 'max:255'],
        ]);

        $data =  M_cust::find(request()->get('id_cust'));
        $data->nama_cust = $request->get('nama_cust');
        $data->option_cust = $request->get('option_cust');
        $data->alamat_cust = $request->get('alamat_cust');
        // dd($file);

        $data->update();

        return redirect()->back()->with('pesan', 'Data Berhasil Diupdate!!');
    }

    public function hapusCust()
    {
        DB::table('tbl_customer')->where('id_cust', request()->get('id_cust'))->delete();
        return redirect()->back()->with('pesan', 'Data Berhasil Dihapus!');
    }
}
