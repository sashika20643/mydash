@extends('layouts.master')
@section('content')
    <style>
        .custom-margin-top {
            margin-top: 8px;
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

            </div>

            <section id="main-content">

                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                Settings
                            </div>
                            <div class="card-body">
                                <div class="basic-elements">
                                    <form action="{{ url('/') }}/api/setting/store" method="post"
                                        enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="device" value="web">
                                        <input type="hidden" name="set_id" value="{{ $settings->id }}">

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Login Bonus</label>
                                                    <input type="text" name="login_bonus" class="form-control"
                                                        value="{{ $settings->login_bonus }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Free Recharge</label>
                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[0])) {{ $free_charge[0]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[1])) {{ $free_charge[1]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[2])) {{ $free_charge[2]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[3])) {{ $free_charge[3]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[4])) {{ $free_charge[4]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[5])) {{ $free_charge[5]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[6])) {{ $free_charge[6]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[7])) {{ $free_charge[7]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[8])) {{ $free_charge[8]->name }} @endif ">

                                                    <input type="text" name="free_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($free_charge[9])) {{ $free_charge[9]->name }} @endif ">


                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Big Event Image</label>
                                                    <input type="file" name="big_event_image" class="form-control">
                                                    @if ($settings->big_event_image)
                                                        <img src="{{ $settings->big_event_image }}"
                                                            style="width: 127px;
                                                                                                                                                                        object-fit: cover;  height: 127px; margin-top: 15px;">
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label>Big Event</label>
                                                    <select name="big_event" class="form-control">
                                                        <option value="">Select Event Image</option>
                                                        <option value="no" @if ($settings->big_event == 'no') selected @endif>No</option>
                                                        <option value="yes" @if ($settings->big_event == 'yes') selected @endif>Yes</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Vip Subscription Plan</label>
                                                    <input type="text" name="vsp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($vsp[0])) {{ $vsp[0]->name }} @endif">
                                                    <input type="text" name="vsp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($vsp[1])) {{ $vsp[1]->name }} @endif">
                                                    <input type="text" name="vsp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($vsp[2])) {{ $vsp[2]->name }} @endif">
                                                    <input type="text" name="vsp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($vsp[3])) {{ $vsp[3]->name }} @endif">
                                                    <input type="text" name="vsp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($vsp[4])) {{ $vsp[4]->name }} @endif">
                                                    <input type="text" name="vsp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($vsp[5])) {{ $vsp[5]->name }} @endif">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Point Recharge</label>
                                                    <input type="text" name="point_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($point_recharge[0])) {{ $point_recharge[0]->name }} @endif">

                                                    <input type="text" name="point_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($point_recharge[1])) {{ $point_recharge[1]->name }} @endif">

                                                    <input type="text" name="point_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($point_recharge[2])) {{ $point_recharge[2]->name }} @endif">

                                                    <input type="text" name="point_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($point_recharge[3])) {{ $point_recharge[3]->name }} @endif">

                                                    <input type="text" name="point_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($point_recharge[4])) {{ $point_recharge[4]->name }} @endif">

                                                    <input type="text" name="point_recharge[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($point_recharge[5])) {{ $point_recharge[5]->name }} @endif">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Big Event Point</label>
                                                    <input type="text" name="big_event_point[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($big_event_point[0])) {{ $big_event_point[0]->name }} @endif">

                                                    <input type="text" name="big_event_point[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($big_event_point[1])) {{ $big_event_point[1]->name }} @endif">

                                                    <input type="text" name="big_event_point[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($big_event_point[2])) {{ $big_event_point[2]->name }} @endif">

                                                    <input type="text" name="big_event_point[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($big_event_point[3])) {{ $big_event_point[3]->name }} @endif">

                                                    <input type="text" name="big_event_point[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($big_event_point[4])) {{ $big_event_point[4]->name }} @endif">

                                                    <input type="text" name="big_event_point[]"
                                                        class="form-control custom-margin-top"
                                                        value="@if (isset($big_event_point[5])) {{ $big_event_point[5]->name }} @endif">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Redeem Point Notice</label>
                                                    <input type="text" name="redeem_point_notice" class="form-control"
                                                        value="{{ $settings->redeem_point_notice }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Msg & video call point</label>
                                                    <input type="text" name="mvcp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($mvcp[0])) {{ $mvcp[0]->name }} @endif">
                                                    <input type="text" name="mvcp[]" class="form-control custom-margin-top"
                                                        value="@if (isset($mvcp[1])) {{ $mvcp[1]->name }} @endif">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Invitee Point Rate</label>
                                                    <input type="text" name="invitee_point_rate" class="form-control"
                                                        value="{{ $settings->invitee_point_rate }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label> Korea Won and Dollar Exchange Rate</label>
                                                    <input type="text" name="kwder" class="form-control"
                                                        value="{{ $settings->kwder }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Admob</label>
                                                    <select name="admob" class="form-control">
                                                        <option value="">Select Admob</option>
                                                        <option value="no" @if ($settings->admob == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->admob == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label> Advertisement Image</label>
                                                    <input type="file" name="advertisment_image" class="form-control">
                                                    @if ($settings->advertisment_image)
                                                        <img src="{{ $settings->advertisment_image }}"
                                                            style="width: 127px;
                                                                                                                                                                        object-fit: cover;  height: 127px; margin-top: 15px;">
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Advertisement link Address</label>
                                                    <input type="text" name="ald" class="form-control"
                                                        value="{{ $settings->ald }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label> In-stream ad</label>
                                                    <select name="in_stream_add" class="form-control">
                                                        <option value="">Select In-stream ad</option>
                                                        <option value="no" @if ($settings->in_stream_add == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->in_stream_add == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Video</label>
                                                    <input type="text" name="video" class="form-control"
                                                        value="{{ $settings->video }}">
                                                </div>

                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label> Video link Address</label>
                                                    <input type="text" name="vld" class="form-control"
                                                        value="{{ $settings->vld }}">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Terms of use</label>
                                                    <input type="text" name="term_of_use" class="form-control"
                                                        value="{{ $settings->term_of_use }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Location Based Service Terms</label>
                                                    <input type="text" name="lbst" class="form-control"
                                                        value="{{ $settings->lbst }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Personal Information Handling Method</label>
                                                    <input type="text" name="pihd" class="form-control"
                                                        value="{{ $settings->pihd }}">
                                                </div>

                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>live stream API switch</label>
                                                    <select name="lsaw" class="form-control">
                                                        <option value="">select live stream</option>
                                                        <option value="Agora" @if ($settings->lsaw == 'Agora')

                                                            @endif>Agora</option>
                                                        <option value="Alibaba" @if ($settings->lsaw == 'Alibaba')

                                                            @endif>Alibaba</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Google Play's billing system Android</label>
                                                    <select name="gpbs_android" class="form-control">
                                                        <option value="">Select Google Play's billing</option>
                                                        <option value="no" @if ($settings->gpbs_android == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->gpbs_android == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Paypal payment gateway Android</label>
                                                    <select name="ppg_android" class="form-control">
                                                        <option value="">Select Paypal payment gateway</option>
                                                        <option value="no" @if ($settings->ppg_android == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->ppg_android == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Payoneer payment gateway Android</label>
                                                    <select name="payonner_pg_android" class="form-control">
                                                        <option value="">Select Payoneer payment gateway</option>
                                                        <option value="no" @if ($settings->payonner_pg_android == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->payonner_pg_android == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>iOS billing system </label>
                                                    <select name="ios_bs" class="form-control">
                                                        <option value="">Select iOS billing system</option>
                                                        <option value="no" @if ($settings->ios_bs == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->ios_bs == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Paypal Payment Gateway IOS </label>
                                                    <select name="ppg_ios" class="form-control">
                                                        <option value="">Paypal Payment Gateway IOS</option>
                                                        <option value="no" @if ($settings->ppg_ios == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->ppg_ios == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                                <div class="form-group">
                                                    <label>Payoneer payment gateway IOS</label>
                                                    <select name="payoneer_pg_ios" class="form-control">
                                                        <option value="">Payoneer payment gateway IOS</option>
                                                        <option value="no" @if ($settings->payoneer_pg_ios == 'no') selected

                                                            @endif>No</option>
                                                        <option value="yes" @if ($settings->payoneer_pg_ios == 'yes') selected

                                                            @endif>Yes</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                        </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->


    <div class="row">
        <div class="col-lg-12">
            <div class="footer">
                <p>2018 © Admin Board. - <a href="#">example.com</a></p>
            </div>
        </div>
    </div>
    </section>
    </div>


    </div>




    <script>
        $("#add_country").click(function() {
            $("#exampleModal").modal('show');
        });

        $(document).ready(function() {
            $('#example').DataTable();
        });


        function edit(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/user-profile-details',
                data: {
                    id: id
                },
                success: function(res) {
                    const obj = JSON.parse(res);
                    $("#edit_name").val(obj.name);
                    $("#user_id").val(obj.id);
                    $("#edit_password").val(obj.show_password);
                }
            });
            $("#edit-modal").modal('show');
        }

        function deletes(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/user/profile/destroy',
                data: {
                    id: id,
                    device: "web"
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Users Delete Successfully');
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
