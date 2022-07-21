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
                                <li class="breadcrumb-item active" aria-current="page">Report</li>
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
                        <table class="table align-items-center table-flush" id="masterreport-dt">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">No</th>
                                    <th scope="col" class="sort" data-sort="status">Tanggal</th>
                                    <th scope="col">Tertanda Tangan</th>
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
    {{-- Hapus --}}
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin hapus data?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/hapus_reportAdmin" enctype="multipart/form-data" id="formHapus">
                        @csrf
                        <input type="hidden" id="id_report" class="form-control" name="id_report">
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
        let list_report = [];

        const table = $("#masterreport-dt").DataTable({
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
                url: "{{ url('list_reportAdmin') }}",
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
                    return `<img id="ttd" src="{{ url('') }}/dok_ttd/${row.ttd}"
                                                width="70" height="70">`;
                }
            }, {
                "targets": 3,
                "data": "by_aspv",
                "render": function(data, type, row, meta) {
                    var status = ``;
                    if (data == 1 && row.by_spv == 1 && row.by_asmng == 1 && row.by_mng == 1) {
                        status += `<p>Approved Selesai</p>`
                    } else if (data == 1 || row.by_spv == 1 || row.by_asmng == 1 || row.by_mng == 1) {
                        status += `<p>Pending</p>`
                    } else if (data == 2 || row.by_spv == 2 || row.by_asmng == 2 || row.by_mng == 2) {
                        status += `<p>Revision</p>`
                    } else if (data == 3 || row.by_spv == 3 || row.by_asmng == 3 || row.by_mng == 3) {
                        status += `Rejected`
                    } else {
                        status += `<p>--</p>`
                    }
                    return status;
                }
            }, {
                "targets": 4,
                "sortable": false,
                "data": "by_aspv",
                "render": function(data, type, row, meta) {
                    return `<a class="btn btn-sm btn-success" href="/edit_reportAdmin/${row.id_report}">Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="hapus(${row.id_report})">Hapus</button>
                            <a class="btn btn-sm btn-warning" href="{{ url('') }}/report_print/${row.id_report}" id="btnprn" target="_blank">Cetak</a>`;
                }
                //  <a data-bs-toggle="modal" data-bs-target="#modalDetail"><i class='lni lni-eye'></i></a>
            }, ]
        });

        function showEditForm(id_report) {
            const report = list_report[id_report]

            // console.log(report)
            $('#modalEdit').modal('show')
            $("#formEdit [name='id_report']").val(report.id_report)
            $("#formEdit [name='model_report']").val(report.model_report)
            $("#formEdit [name='serial_number']").val(report.serial_number)
        }

        function hapus(id_report) {
            // console.log(id)
            $('#modalHapus').modal('show')
            const report = list_report[id_report]
            $("#formHapus [name='id_report']").val(report.id_report)
        }

        $(document).ready(function() {
            $('#btnprn').printPage();
        });
    </script>
@stop
