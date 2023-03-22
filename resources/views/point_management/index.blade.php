@extends('layouts.master')
@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
    <div class="content-body">

        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-0">Your business dashboard template</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Layout</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Blank</a></li>
                    </ol>
                </div>
            </div>



            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title">Point Management</h4>
                        </div>
                        <div class="card-body" style="overflow: scroll;">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                    <div class="form-group">
                                        <button type="button" name="filter" id="filter" class="btn btn-success"
                                            style="margin-top: 28px;">Filter</button>
                                    </div>
                                </div>
                            </div>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Record ID</th>
                                        <th>Transaction Type</th>
                                        <th>Phone Number</th>
                                        <th>Name</th>
                                        <th>Invitee Ph No</th>
                                        <th>Invitee Name</th>
                                        <th>Partner Ph No</th>
                                        <th>Partner Name</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Period</th>
                                        <th>Point</th>
                                        <th>Sum</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ajax_request">
                                    <?php $count = 0; ?>
                                    @if ($point_management->count() > 0)
                                        @foreach ($point_management->get() as $value)
                                            <?php 
                                                $count++;
                                                ?>
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->trans_type }}</td>
                                                <td>{{ $value->phone_number }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->invitee_ph }}</td>
                                                <td>{{ $value->invitee_name }}</td>
                                                <td>{{ $value->partner_ph }}</td>
                                                <td>{{ $value->partner_name }}</td>
                                                <td>{{ $value->dates }}</td>
                                                <td>{{ $value->start_time }}</td>
                                                <td>{{ $value->end_time }}</td>
                                                <td>{{ $value->period }}</td>
                                                <td>{{ $value->debit }}</td>
                                                <td>{{ $value->credit }}</td>
                                                <td>{{ $value->balance }}</td>
                                                <td>
                                                    <a
                                                        href="{{ url('/') }}/payment-redeem-request/{{ $value->id }}">
                                                        <button type="button" name="show_history" id="show_history"
                                                            class="btn btn-sm btn-primary" @if ($value->pr_request == 1) style="color:red;" disabled

                                        @endif>Check</button></a>
                                        </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="14" class="text-center">Point Management not found</td>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <script>
        $("#filter").click(function() {
            var start_date = $("#start_date").val();
            var end_date = $("#start_date").val();
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/filter-point',
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(res) {
                    $("#ajax_request").html(res);
                }
            })
        })

        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection
