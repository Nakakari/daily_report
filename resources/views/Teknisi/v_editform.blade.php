@extends('layouts.main')
@section('isi')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="/report">Report</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Technical Report</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <!-- Card stats -->

            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Technical Report </h3>
                            </div>

                        </div>
                    </div>
                    <form id="tech_report" enctype="multipart/form-data" action="/update_report/{{ $id_report }}"
                        method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Customer</label>
                                            <select class="form-control form-select" aria-label="Default select example"
                                                name="id_cust" id="id_cust">
                                                <option selected>Pilih Customer</option>
                                                @foreach ($customer as $c)
                                                    <option value="{{ $c->id_cust }}"
                                                        {{ $c->id_cust == $report->id_cust ? 'selected' : '' }}>
                                                        {{ $c->nama_cust }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Date</label>
                                            <input type="date" id="input-email" class="form-control" name="date"
                                                value="{{ $report->date }}">
                                            <input type="hidden" id="input-email" class="form-control" name="by_aspv"
                                                value="0">
                                            <input type="hidden" id="input-email" class="form-control" name="by_spv"
                                                value="0">
                                            <input type="hidden" id="input-email" class="form-control" name="by_asmng"
                                                value="0">
                                            <input type="hidden" id="input-email" class="form-control" name="by_mng"
                                                value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Address</label>
                                            <textarea class="form-control" name="alamat_cust" id="alamat_cust" placeholder="Alamat Pengirim..." rows="3"
                                                readonly>{{ $report->alamat_cust }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Status</label>
                                            <select class="form-control form-select" aria-label="Default select example"
                                                name="id_status" id="id_status">
                                                <option selected>Pilih Status</option>
                                                @foreach ($status as $s)
                                                    <option value="{{ $s->id_status }}"
                                                        {{ $s->id_status == $report->id_status ? 'selected' : '' }}>
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
                                                name="id_mesin" id="id_mesin">
                                                <option selected>Pilih Model Mesin</option>
                                                @foreach ($mesin as $p)
                                                    <option value="{{ $p->id_mesin }}"
                                                        {{ $p->id_mesin == $report->id_mesin ? 'selected' : '' }}>
                                                        {{ $p->model_mesin }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Problem</label>
                                            <select class="form-control selectpicker" id="problemedit"
                                                name="problemEdit[]" multiple data-live-search="true">
                                                @foreach ($problem as $pro)
                                                    <?php
                                                    $selected = false;
                                                    foreach ($problem2 as $pro2) {
                                                        if ($pro->id_problem == $pro2->id_problem) {
                                                            $selected = true;
                                                        }
                                                    }
                                                    ?>
                                                    <option value="{{ $pro->id_problem }}"
                                                        {{ $selected ? 'selected' : '' }}>
                                                        {{ $pro->nama_problem }}
                                                    </option>
                                                @endforeach
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
                                                value="{{ $report->serial_number }}">
                                            <input type="hidden" id="id_work_for" name="id_work_for"
                                                class="form-control" placeholder="Serial Number"
                                                value="{{ Auth::user()->id }}">
                                            <input type="hidden" id="id_work_for" name="id_report" class="form-control"
                                                placeholder="Serial Number" value="{{ $id_report }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Counter After</label>
                                            <input type="text" id="input-city" name="counter_after"
                                                class="form-control" value="{{ $report->counter_after }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Option</label>
                                            <input type="text" id="option_cust" name="option_cust"
                                                class="form-control" readonly value="{{ $report->option_cust }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Counter
                                                Before</label>
                                            <input type="text" id="input-city" name="counter_before"
                                                class="form-control" value="{{ $report->counter_before }}">
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
                                            <textarea class="form-control" placeholder="Remarks..." rows="5" name="remarks">{{ $report->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">Time Call</label>
                                            <input type="time" id="input-city" class="form-control"
                                                placeholder="City" name="time_call" value="{{ $report->time_call }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Time In</label>
                                            <input type="time" id="input-country" class="form-control"
                                                placeholder="Country" name="time_in" value="{{ $report->time_in }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Time
                                                Out</label>
                                            <input type="time" id="input-postal-code" class="form-control"
                                                placeholder="Postal code" name="time_out"
                                                value="{{ $report->time_out }}">
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
                                            <textarea rows="4" class="form-control" placeholder="Notes ..." name="notes">{{ $report->notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">New Tanda Tangan</label>
                                            <input type="file" id="input-postal-code" class="form-control mb-2"
                                                placeholder="Postal code" name="ttd" value="{{ $report->ttd }}">
                                            {{-- <div class="col text-left">
                                                <a href="/new_report" class="btn btn-sm btn-primary">New Technical
                                                    Report</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success text-left">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        const textarea = document.getElementById('alamat_cust');
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#id_cust').on('change', function() {
                $.ajax({
                    url: '{{ url('kodecust') }}',
                    method: 'POST',
                    data: {
                        id_cust: $(this).val()
                    },
                    success: function(response) {
                        $("#tech_report textarea").val('')
                        $.each(response, function(id_cust, alamat_cust) {
                            textarea.value = alamat_cust;
                        })
                    }
                })
            });
        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#id_cust').on('change', function() {
                $.ajax({
                    url: '{{ url('kodeoption') }}',
                    method: 'POST',
                    data: {
                        id_cust: $(this).val()
                    },
                    success: function(response) {
                        $("#tech_report [name='option_cust']").val('')
                        $.each(response, function(id_cust, option_cust) {
                            $("#tech_report [name='option_cust']").val(option_cust)
                        })
                    }
                })
            });
        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#id_mesin').on('change', function() {
                $.ajax({
                    url: '{{ url('kodemesin') }}',
                    method: 'POST',
                    data: {
                        id_mesin: $(this).val()
                    },
                    success: function(response) {
                        $("#tech_report [name='serial_number']").val('')
                        $.each(response, function(serial_number, model_mesin) {
                            $("#tech_report [name='serial_number']").val(serial_number)
                        })
                    }
                })
            });
        });
    </script>
@stop
