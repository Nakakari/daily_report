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
                                <li class="breadcrumb-item active" aria-current="page">Master Data Customer</li>
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
                            <h3 class="mb-0">Daftar Data Customer</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target=".bd-example-modal-lg">Tambah Data</a>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="mastercust-dt">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">No</th>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/add_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-custname">Nama Lengkap</label>
                                    <input type="text" id="input-custname" class="form-control" name="nama_cust"
                                        placeholder="Jhon Jojon">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Option</label>
                                    <input type="text" id="input-custname" class="form-control" name="option_cust"
                                        placeholder="A123">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Alamat</label>
                                    <textarea id="alamat_cust" type="text" class="form-control" name="alamat_cust" required
                                        placeholder="Alamat Customer" rows="3"></textarea>
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
                <form method="POST" action="/edit_cust" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-custname">Nama Lengkap</label>
                                    <input type="text" id="input-custname" class="form-control" name="nama_cust"
                                        placeholder="Jhon Jojon">
                                    <input type="hidden" id="input-custname" class="form-control" name="id_cust">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Option</label>
                                    <input type="text" id="input-custname" class="form-control" name="option_cust"
                                        placeholder="A123" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Alamat</label>
                                    <textarea id="alamat_cust" type="text" class="form-control" name="alamat_cust" required
                                        placeholder="Alamat Customer" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin hapus data?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/hapus_cust" enctype="multipart/form-data" id="formHapus">
                        @csrf
                        <input type="hidden" id="id_cust" class="form-control" name="id_cust">
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
        let list_cust = [];

        const table = $("#mastercust-dt").DataTable({
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
                url: "{{ url('list_cust') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id_cust",
                "render": function(data, type, row, meta) {
                    list_cust[row.id_cust] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // console.log(list_cust)
                }
            }, {
                "targets": 1,
                "data": "nama_cust",
                "render": function(data, type, row, meta) {
                    return data;

                }
            }, {
                "targets": 2,
                "data": "id_cust",
                "render": function(data, type, row, meta) {
                    return `<p><b>Alamat: </b>` + row.alamat_cust + `<br>` +
                        `<b>Option: </b>` + row.option_cust + `</p>`;
                }
            }, {
                "targets": 3,
                "sortable": false,
                "data": "id_cust",
                "render": function(data, type, row, meta) {
                    return `<button class="btn btn-sm btn-success" onclick="showEditForm(${row.id_cust})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="hapus(${row.id_cust})">Hapus</button>`;
                }
                //  <a data-bs-toggle="modal" data-bs-target="#modalDetail"><i class='lni lni-eye'></i></a>
            }, ]
        });

        function showEditForm(id_cust) {
            const cust = list_cust[id_cust]

            // console.log(cust)
            $('#modalEdit').modal('show')
            $("#formEdit [name='id_cust']").val(cust.id_cust)
            $("#formEdit [name='nama_cust']").val(cust.nama_cust)
            $("#formEdit [name='alamat_cust']").val(cust.alamat_cust)
            $("#formEdit [name='option_cust']").val(cust.option_cust)
        }

        function hapus(id_cust) {
            // console.log(id)
            $('#modalHapus').modal('show')
            const cust = list_cust[id_cust]
            $("#formHapus [name='id_cust']").val(cust.id_cust)
        }
    </script>
@stop
