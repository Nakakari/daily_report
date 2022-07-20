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
                                <li class="breadcrumb-item active" aria-current="page">Daftar Report</li>
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
                            <h3 class="mb-0">Daftar Technical Report</h3>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="masteraspv-dt">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">No</th>
                                    <th scope="col" class="sort" data-sort="status">Tanggal Masuk</th>
                                    <th scope="col">Informasi</th>
                                    <th scope="col">Status</th>
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
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
@stop
@section('js')
    <script type="text/javascript">
        let list_report = [];

        const table = $("#masteraspv-dt").DataTable({
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
                url: "{{ url('list_report_aspv') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id_report",
                "render": function(data, type, row, meta) {
                    list_report[row.id_report] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // console.log(list_report)
                }
            }, {
                "targets": 1,
                "data": "date",
                "render": function(data, type, row, meta) {
                    return data;

                }
            }, {
                "targets": 2,
                "data": "id_report",
                "render": function(data, type, row, meta) {
                    return `<p><b>Customer: </b>` + row.nama_cust + `<br>` +
                        `<b>Address: </b>` + row.alamat_cust + `<br>` +
                        `<b>Model: </b>` + row.model_mesin + `<br></p>` +
                        `<button class="btn btn-sm btn-info" onclick="toggleDetail('${row.id_report}')">Detail</button>`;
                }
            }, {
                "targets": 3,
                "data": "by_aspv",
                "render": function(data, type, row, meta) {
                    var status = ``;
                    if (data == 1) {
                        status += `<p>Ter-Approve</p>`
                    } else if (data == 2) {
                        status += `<p>Revision</p>`
                    } else if (data == 3) {
                        status += `Rejected`
                    } else {
                        `<p>--</p>`
                    }
                    return status;
                }
            }, {
                "targets": 4,
                "sortable": false,
                "data": "by_aspv",
                "render": function(data, type, row, meta) {
                    var tampilan = ``;

                    // var ucwords($kalimat);
                    if (data == 1) {
                        tampilan +=
                            `<button class="btn btn-sm btn-success" onclick="toggleApprove('${row.id_report}')" disabled>Approve</button>
                            <button class="btn btn-sm btn-warning" onclick="toggleRevision('${row.id_report}')" disabled>Revision</button>
                            <button class="btn btn-sm btn-danger" onclick="toggleReject(${row.id_report})" disabled>Reject</button>`
                    } else if (data == 2) {
                        tampilan +=
                            `<button class="btn btn-sm btn-success" onclick="toggleApprove('${row.id_report}')">Approve</button>
                            <button class="btn btn-sm btn-warning" onclick="toggleRevision('${row.id_report}')" disabled>Revision</button>
                            <button class="btn btn-sm btn-danger" onclick="toggleReject(${row.id_report})">Reject</button>`
                    } else if (data == 3) {
                        tampilan +=
                            `<button class="btn btn-sm btn-success" onclick="toggleApprove('${row.id_report}')">Approve</button>
                            <button class="btn btn-sm btn-warning" onclick="toggleRevision('${row.id_report}')">Revision</button>
                            <button class="btn btn-sm btn-danger" onclick="toggleReject(${row.id_report})" disabled>Reject</button>`
                    } else {
                        tampilan +=
                            `<button class="btn btn-sm btn-success" onclick="toggleApprove('${row.id_report}')">Approve</button>
                            <button class="btn btn-sm btn-warning" onclick="toggleRevision('${row.id_report}')">Revision</button>
                            <button class="btn btn-sm btn-danger" onclick="toggleReject(${row.id_report})">Reject</button>`
                    }
                    return tampilan;
                }
                //  <a data-bs-toggle="modal" data-bs-target="#modalDetail"><i class='lni lni-eye'></i></a>
            }, ]
        });

        function toggleApprove(id_report) {

            const _c = confirm("Apakah Anda yakin mengapprove daily report?")
            if (_c === true) {
                let report = list_report[id_report]
                const by_aspv_update = 1;
                $.ajax({
                    url: '{{ url('') }}/by_aspv/approve',
                    method: 'POST',
                    data: {
                        id_report: id_report,
                        by_aspv: by_aspv_update,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res === true) {
                            table.ajax.reload(null, false)
                        }
                    }
                })
            }
        };

        function toggleRevision(id_report) {

            const _c = confirm("Apakah Anda yakin merevisi daily report?")
            if (_c === true) {
                let report = list_report[id_report]
                const by_aspv_update = 2;
                $.ajax({
                    url: '{{ url('') }}/by_aspv/revision',
                    method: 'POST',
                    data: {
                        id_report: id_report,
                        by_aspv: by_aspv_update,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res === true) {
                            table.ajax.reload(null, false)
                        }
                    }
                })
            }
        };

        function toggleReject(id_report) {

            const _c = confirm("Apakah Anda yakin mereject daily report?")
            if (_c === true) {
                let report = list_report[id_report]
                const by_aspv_update = 3;
                $.ajax({
                    url: '{{ url('') }}/by_aspv/reject',
                    method: 'POST',
                    data: {
                        id_report: id_report,
                        by_aspv: by_aspv_update,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res === true) {
                            table.ajax.reload(null, false)
                        }
                    }
                })
            }
        };

        function toggleDetail(id_report) {
            const report = list_report[id_report]

            // console.log(mesin)
            $('#modalDetail').modal('show')
            $("#formEdit [name='id_mesin']").val(mesin.id_mesin)
            $("#formEdit [name='model_mesin']").val(mesin.model_mesin)
            $("#formEdit [name='serial_number']").val(mesin.serial_number)
        }
    </script>
@stop
