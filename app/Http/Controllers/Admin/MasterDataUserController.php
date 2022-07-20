<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\M_peran;
use App\Models\M_jk;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterDataUserController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'peran' => M_peran::getAll(),
            'jk' => M_jk::all()
        ];
        // $peran = M_peran::getAll();
        return view('Admin.v_masterdataUser', $data);
        // dd($data['peran']);
    }

    public function listUser()
    {
        $columns = [
            'id',
            'name',
            'username',
            'peran'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = User::select('*')
            ->join('tbl_peran', 'tbl_peran.id_peran', '=', 'users.peran')
            ->join('tbl_jk', 'tbl_jk.id_jk', '=', 'users.jk')
            ->orderBy('id', "desc");;

        $recordsFiltered = $data->get()->count(); //menghitung data yang sudah difilter

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(users.name) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
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

    public function addUser(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            "peran" => 'required',
            "jk" => 'required',
            "no_hp" => 'required',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'foto_users';
        $file->move($tujuan_upload, $nama_file);

        $data = new User();
        $data->name = $request->get('name');
        $data->password = Hash::make($request->get('password'));
        $data->username = $request->get('username');
        $data->peran = $request->get('peran');
        $data->jk = $request->get('jk');
        $data->no_hp = $request->get('no_hp');
        $data->foto = $nama_file;

        // dd($file);

        $data->save();

        return redirect()->back()->with('pesan', 'Data Berhasil Ditambah!!');
    }

    public function editUser(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['required', 'string', 'max:255'],
            "peran" => 'required',
            "jk" => 'required',
            "no_hp" => 'required',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'foto_users';
        $file->move($tujuan_upload, $nama_file);

        $data =  User::find(request()->get('id'));
        $data->name = $request->get('name');
        $data->password = Hash::make($request->get('password'));
        $data->username = $request->get('username');
        $data->peran = $request->get('peran');
        $data->jk = $request->get('jk');
        $data->no_hp = $request->get('no_hp');
        $data->foto = $nama_file;

        $data->update();

        return redirect()->back()->with('pesan', 'Data Berhasil Diupdate!');
    }

    public function hapusUser()
    {
        DB::table('users')->where('id', request()->get('id'))->delete();
        return redirect()->back()->with('pesan', 'Data Berhasil Dihapus!');
    }
}
