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
    @foreach ($report as $r)
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
                    <form id="tech_report" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Address</label>
                                            <textarea class="form-control" name="alamat_cust" id="alamat_cust" placeholder="Alamat Pengirim..." rows="3"
                                                readonly>{{ $r->alamat_cust }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Status</label>
                                            <select class="form-control form-select" aria-label="Default select example"
                                                name="id_status" id="id_status" disabled>
                                                <option selected>Pilih Status</option>
                                                @foreach ($status as $s)
                                                    <option value="{{ $s->id_status }}"
                                                        {{ $s->id_status == $r->id_status ? 'selected' : '' }}>
                                                        {{ $s->nama_status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Model</label>
                                            <select class="form-control form-select" aria-label="Default select example"
                                                name="id_mesin" id="id_mesin" disabled>
                                                <option selected>Pilih Model Mesin</option>
                                                @foreach ($mesin as $p)
                                                    <option value="{{ $p->id_mesin }}"
                                                        {{ $p->id_mesin == $r->id_mesin ? 'selected' : '' }}>
                                                        {{ $p->model_mesin }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Problem</label>
                                            <select class="form-control selectpicker" id="problem" name="problem[]"
                                                multiple data-live-search="true" disabled>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">S / N</label>
                                            <input type="text" name="serial_number" id="serial_number"
                                                class="form-control" placeholder="Serial Number" readonly
                                                value="{{ $r->serial_number }}">
                                            <input type="hidden" id="id_work_for" name="id_work_for"
                                                class="form-control" placeholder="Serial Number"
                                                value="{{ Auth::user()->id }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Counter After</label>
                                            <input type="text" id="input-city" name="counter_after"
                                                class="form-control" disabled value="{{ $r->counter_after }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Option</label>
                                            <input type="text" id="option_cust" name="option_cust"
                                                class="form-control" readonly value="{{ $r->option_cust }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Counter
                                                Before</label>
                                            <input type="text" id="input-city" name="counter_before"
                                                class="form-control" disabled value="{{ $r->counter_before }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Address -->
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Remarks</label>
                                            <textarea class="form-control" placeholder="Remarks..." rows="5" name="remarks" disabled>{{ $r->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">Time Call</label>
                                            <input type="time" id="input-city" class="form-control"
                                                placeholder="City" name="time_call" value="{{ $r->time_call }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Time In</label>
                                            <input type="time" id="input-country" class="form-control"
                                                placeholder="Country" name="time_in" value="{{ $r->time_in }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Time
                                                Out</label>
                                            <input type="time" id="input-postal-code" class="form-control"
                                                placeholder="Postal code" name="time_out" value="{{ $r->time_out }}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">Work For</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label">Notes</label>
                                            <textarea rows="4" class="form-control" placeholder="Notes ..." name="notes" disabled>{{ $r->notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Tanda Tangan</label><br>
                                            <img id="ttd" src="{{ url('') }}/dok_ttd/{{ $r->ttd }}"
                                                width="70" height="70">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
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
                url: "{{ url('list_report_spv') }}",
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
                        `<a class="btn btn-sm btn-info" href="detail_report2/${row.id_report}">Detail</a>`;
                }
            }, {
                "targets": 3,
                "data": "by_spv",
                "render": function(data, type, row, meta) {
                    var status = ``;
                    if (data == 1) {
                        status += `<p>Ter-Approve</p>`
                    } else if (data == 2) {
                        status += `<p>Revision</p>`
                    } else if (data == 3) {
                        status += `Rejected`
                    } else {
                        status += `<p>--</p>`
                    }
                    return status;
                }
            }, {
                "targets": 4,
                "sortable": false,
                "data": "by_spv",
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
                            `<button class="btn btn-sm btn-success" onclick="toggleApprove('${row.id_report}')" disabled>Approve</button>
                            <button class="btn btn-sm btn-warning" onclick="toggleRevision('${row.id_report}')" disabled>Revision</button>
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
                const by_spv_update = 1;
                $.ajax({
                    url: '{{ url('') }}/by_spv/approve',
                    method: 'POST',
                    data: {
                        id_report: id_report,
                        by_spv: by_spv_update,
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
                const by_spv_update = 2;
                $.ajax({
                    url: '{{ url('') }}/by_spv/revision',
                    method: 'POST',
                    data: {
                        id_report: id_report,
                        by_spv: by_spv_update,
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
                const by_spv_update = 3;
                $.ajax({
                    url: '{{ url('') }}/by_spv/reject',
                    method: 'POST',
                    data: {
                        id_report: id_report,
                        by_spv: by_spv_update,
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

        function detail(id_report) {
            // console.log(id)
            $('#modalDetail').modal('show')
            const report = list_report[id_report]
            $.ajax({
                url: "{{ url('detail_problem') }}?id_report=" + id_report,
                success: function(res) {
                    // console.log(res)
                    $("#modalDetail #problem").val(res.id_problem)

                }
            })
        }
    </script>
@stop
