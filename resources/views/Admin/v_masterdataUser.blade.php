@extends('layouts.main')
@section('css')
    <style>
        .dataTables_info {
            padding-left: 15px;
            padding-bottom: 15px;
        }

        .dataTables_paginate {
            padding-left: 15px;
            padding-bottom: 15px;
        }
    </style>
@stop
@section('isi')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Daily Report</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a>
                                </li>
                                {{-- <li class="breadcrumb-item"><a href="#">Dashboards</a></li> --}}
                                <li class="breadcrumb-item active" aria-current="page">Master Data User</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <!-- Card stats -->

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid mt--6">
            @if (session('pesan'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('pesan') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('gagal'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('hapus') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Ups!</strong> {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="col">
                            <h3 class="mb-0">Daftar Data User</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target=".bd-example-modal-lg">Tambah Data</a>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="masteruser-dt">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">No</th>
                                    <th scope="col" class="sort" data-sort="budget"></th>
                                    <th scope="col" class="sort" data-sort="status">Nama</th>
                                    <th scope="col">Informasi</th>
                                    <th scope="col" class="sort" data-sort="completion">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('modal')
    {{-- Modal Tambah --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/add_user" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Nama Lengkap</label>
                                    <input type="text" id="input-username" class="form-control" name="name"
                                        placeholder="Jhon Jojon">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Username</label>
                                    <input type="text" id="input-username" class="form-control" name="username"
                                        placeholder="jojhon123">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="current-password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No. HP</label>
                                    <input type="text" name="no_hp" id="input-last-name" class="form-control"
                                        placeholder="+628510101010">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Jenis Kelamin</label>
                                    <select class="form-control form-select" aria-label="Default select example"
                                        name="jk">
                                        <option selected>Pilih Jenis Kelamin</option>
                                        @foreach ($jk as $j)
                                            <option value="{{ $j->id_jk }}">{{ $j->nama_jk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Peran</label>
                                    <select class="form-control form-select" aria-label="Default select example"
                                        name="peran">
                                        <option selected>Pilih Peran</option>
                                        @foreach ($peran as $p)
                                            <option value="{{ $p->id_peran }}">{{ $p->nama_peran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">File Foto</label>
                                    <input id="file_fotoedited" type="file" class="form-control" name="foto"
                                        required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalEdit"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/edit_user" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Nama Lengkap</label>
                                    <input type="text" id="input-username" class="form-control" name="name">
                                    <input type="hidden" id="id" class="form-control" name="id">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Username</label>
                                    <input type="text" id="input-username" class="form-control" name="username"
                                        placeholder="jojhon123">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">New Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="current-password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No. HP</label>
                                    <input type="text" name="no_hp" id="input-last-name" class="form-control"
                                        placeholder="+628510101010">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Jenis Kelamin</label>
                                    <select class="form-control form-select" aria-label="Default select example"
                                        name="jk">
                                        <option selected>Pilih Jenis Kelamin</option>
                                        @foreach ($jk as $j)
                                            <option value="{{ $j->id_jk }}">{{ $j->nama_jk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Peran</label>
                                    <select class="form-control form-select" aria-label="Default select example"
                                        name="peran">
                                        <option selected>Pilih Peran</option>
                                        @foreach ($peran as $p)
                                            <option value="{{ $p->id_peran }}">{{ $p->nama_peran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">File Foto</label>
                                    <input id="file_fotoedited" type="file" class="form-control" name="foto"
                                        required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Hapus --}}
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin hapus data?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/hapus_user" enctype="multipart/form-data" id="formHapus">
                        @csrf
                        <input type="hidden" id="id" class="form-control" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        let list_user = [];

        const table = $("#masteruser-dt").DataTable({
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "order": [
                [1, "asc"]
            ],
            "ajax": {
                url: "{{ url('list_user') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "name",
                "render": function(data, type, row, meta) {
                    list_user[row.id] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // console.log(list_user)
                }
            }, {
                "targets": 1,
                "data": "name",
                "render": function(data, type, row, meta) {
                    return `<a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image pengguna" src="{{ url('') }}/foto_users/${row.foto}">
                            </a>`;

                }
            }, {
                "targets": 2,
                "data": "name",
                "render": function(data, type, row, meta) {
                    return `<p><b>Nama Lengkap: </b>` + data + `<br>` +
                        `Username: ` + row.username + `</p>`;
                }
            }, {
                "targets": 3,
                "data": "peran",
                "render": function(data, type, row, meta) {
                    return `<p><b>Nama Peran: </b>` + row.nama_peran + `<br>` +
                        `<b>Jenis Kelamin: </b>` + row.nama_jk + `</p>`;
                }
            }, {
                "targets": 4,
                "sortable": false,
                "data": "id",
                "render": function(data, type, row, meta) {
                    return `<button class="btn btn-sm btn-success" onclick="showEditForm(${row.id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="hapus(${row.id})">Hapus</button>`;
                }
                //  <a data-bs-toggle="modal" data-bs-target="#modalDetail"><i class='lni lni-eye'></i></a>
            }, ]
        });

        function showEditForm(id) {
            const user = list_user[id]

            // console.log(user)
            $('#modalEdit').modal('show')
            $("#formEdit [name='id']").val(user.id)
            $("#formEdit [name='name']").val(user.name)
            $("#formEdit [name='username']").val(user.username)
            $("#formEdit [name='no_hp']").val(user.no_hp)
            $("#formEdit [name='jk']").val(user.jk)
            $("#formEdit [name='peran']").val(user.peran)
            $("#formEdit [name='foto']").val(user.foto)
        }

        function hapus(id) {
            // console.log(id)
            $('#modalHapus').modal('show')
            const user = list_user[id]
            $("#formHapus [name='id']").val(user.id)
        }
    </script>
@stop
