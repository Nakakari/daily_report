<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_peran;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        return view('adminHome', $data);
    }

    public function teknisiHome()
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        return view('teknisiHome', $data);
    }

    public function assspvHome()
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        return view('assspvHome', $data);
    }

    public function spvHome()
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        return view('spvHome', $data);
    }

    public function asmngHome()
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        return view('asmngHome', $data);
    }

    public function mngHome()
    {
        $data = [
            'peran' => M_peran::getAll(),
        ];
        return view('mngHome', $data);
    }
}
