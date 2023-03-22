@extends('layouts.master')
@section('content')
    <?php
    $charged_point = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '=', 'point charges']])
        ->sum('credit');

    $used_point = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '!=', 'redeem request']])
        ->sum('debit');

    $total_invitor = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '=', 'get invitee video call point']])
        ->sum('credit');

    $total_payment_redeem = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '=', 'redeem request']])
        ->sum('debit');
    ?>
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
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-money text-success border-success"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Charged Point</div>
                                <div class="stat-digit">{{ $charged_point }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-user text-primary border-primary"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Used Point</div>
                                <div class="stat-digit">{{ $used_point }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-layout-grid2 text-pink border-pink"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Invitor Point</div>
                                <div class="stat-digit">{{ $total_invitor }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-link text-danger border-danger"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Total Payment Request</div>
                                <div class="stat-digit">{{ $total_payment_redeem }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Point Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                    <div class="form-group">
                                        <button type="button" name="search" id="search" class="btn btn-primary"
                                            style="margin-top: 27px;">Search</button>
                                        <button type="button" name="clear" id="clear" class="btn btn-danger"
                                            style="margin-top: 27px;">Clear</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table student-data-table m-t-20">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Date</th>
                                            <th>Charged Point</th>
                                            <th>Used Point</th>
                                            <th>Invitor Point</th>
                                            <th>Redeem Point</th>
                                        </tr>
                                    </thead>
                                    <tbody id="filter_point_management">
                                        <?php $count = 0; ?>
                                        @foreach ($point_info as $value)
                                            <?php
                                            $count++;
                                            $charged_points = DB::table('point_management')
                                                ->where([['status', '=', 1], ['trans_type', '=', 'point charges'], ['created_at', '=', $value->created_at]])
                                                ->sum('credit');

                                            $used_points = DB::table('point_management')
                                                ->where([['status', '=', 1], ['trans_type', '!=', 'redeem request'], ['created_at', '=', $value->created_at]])
                                                ->sum('debit');

                                            $total_invitors = DB::table('point_management')
                                                ->where([['status', '=', 1], ['trans_type', '=', 'get invitee video call point'], ['created_at', '=', $value->created_at]])
                                                ->sum('credit');

                                            $total_payment_redeems = DB::table('point_management')
                                                ->where([['status', '=', 1], ['trans_type', '=', 'redeem request'], ['created_at', '=', $value->created_at]])
                                                ->sum('debit');
                                            ?>
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ $charged_points }}</td>
                                                <td>{{ $used_points }}</td>
                                                <td>{{ $total_invitors }}</td>
                                                <td>{{ $total_payment_redeems }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <script>
        $("#search").click(function() {
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            $.ajax({
                type: "GET",
                url: "<?php echo url('/'); ?>/filter-point-management",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(res) {
                    $("#filter_point_management").html(res);
                }
            });
        });

        $("#clear").click(function() {
            $("#start_date").val('');
            $("#end_date").val('');
        });
    </script>
@endsection
