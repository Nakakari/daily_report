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
                                <li class="breadcrumb-item active" aria-current="page">Master Data Mesin</li>
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
                            <h3 class="mb-0">Daftar Data Mesin</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target=".bd-example-modal-lg">Tambah Data</a>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="mastermesin-dt">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">No</th>
                                    <th scope="col" class="sort" data-sort="status">Model Mesin</th>
                                    <th scope="col">Serial Number</th>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Mesin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/add_mesin" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-mesinname">Model Mesin</label>
                                    <input type="text" id="input-mesinname" class="form-control" name="model_mesin"
                                        placeholder="PGC 283">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Serial Number</label>
                                    <input type="text" id="input-mesinname" class="form-control" name="serial_number"
                                        placeholder="M/00/A1">
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
                <form method="POST" action="/edit_mesin" enctype="multipart/form-data" id="formEdit">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-mesinname">Model Mesin</label>
                                    <input type="text" id="input-mesinname" class="form-control" name="model_mesin"
                                        placeholder="PGC 283">
                                    <input type="hidden" id="input-mesinname" class="form-control" name="id_mesin">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Serial Number</label>
                                    <input type="text" id="input-mesinname" class="form-control" name="serial_number"
                                        placeholder="M/00/A1">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data Mesin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin hapus data?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/hapus_mesin" enctype="multipart/form-data" id="formHapus">
                        @csrf
                        <input type="hidden" id="id_mesin" class="form-control" name="id_mesin">
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
        let list_mesin = [];

        const table = $("#mastermesin-dt").DataTable({
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
                url: "{{ url('list_mesin') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id_mesin",
                "render": function(data, type, row, meta) {
                    list_mesin[row.id_mesin] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // console.log(list_mesin)
                }
            }, {
                "targets": 1,
                "data": "model_mesin",
                "render": function(data, type, row, meta) {
                    return data;

                }
            }, {
                "targets": 2,
                "data": "serial_number",
                "render": function(data, type, row, meta) {
                    return data;
                }
            }, {
                "targets": 3,
                "sortable": false,
                "data": "id_mesin",
                "render": function(data, type, row, meta) {
                    return `<button class="btn btn-sm btn-success" onclick="showEditForm(${row.id_mesin})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="hapus(${row.id_mesin})">Hapus</button>`;
                }
                //  <a data-bs-toggle="modal" data-bs-target="#modalDetail"><i class='lni lni-eye'></i></a>
            }, ]
        });

        function showEditForm(id_mesin) {
            const mesin = list_mesin[id_mesin]

            // console.log(mesin)
            $('#modalEdit').modal('show')
            $("#formEdit [name='id_mesin']").val(mesin.id_mesin)
            $("#formEdit [name='model_mesin']").val(mesin.model_mesin)
            $("#formEdit [name='serial_number']").val(mesin.serial_number)
        }

        function hapus(id_mesin) {
            // console.log(id)
            $('#modalHapus').modal('show')
            const mesin = list_mesin[id_mesin]
            $("#formHapus [name='id_mesin']").val(mesin.id_mesin)
        }
    </script>
@stop
