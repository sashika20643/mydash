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

                            <h4 class="card-title">Live User Host</h4>
                        </div>
                        <div class="card-body" style="overflow: scroll;">
                            <table id="dtBasicExample" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Bio</th>
                                        <th>Point</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Created At</th>
                                        <th>Invited By</th>
                                        <th>Show History</th>
                                        <th>Notification</th>
                                        <th>Is Host</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user->count() > 0)
                                        @foreach ($user->get() as $value)
                                            <tr>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->phone_number }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->age }}</td>
                                                <td>{{ $value->bio }}</td>
                                                <td>{{ $value->point }}</td>
                                                <td>{{ $value->country }}</td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ $value->invited_by }}</td>
                                                <td>
                                                    <button type="button" name="show_history" id="show_history"
                                                        class="btn btn-sm btn-success">Show History</button>
                                                </td>

                                                <td>
                                                    <button type="button" name="show_history" id="show_history"
                                                        class="btn btn-sm btn-primary">Send Push</button>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" @isset($value->isHost)
                                                                @if ($value->isHost == 1) checked

                                            @endif
                                        @endisset value="{{ $value->id }}">
                                        <span class="slider round"></span>
                                        </label>
                                        </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="14" class="text-center">User not found</td>
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
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            $('input[type="checkbox"]').click(function() {
                var status = 0;
                var id = $(this).val();
                if ($(this).prop("checked") == true) {
                    status = 1;
                } else if ($(this).prop("checked") == false) {
                    status = 0;
                }

                $.ajax({
                    type: 'GET',
                    url: '<?php echo url('/'); ?>/api/liveuser/enable-host',
                    data: {
                        status: status,
                        user_id: id,
                        device: "web"
                    },
                    success: function(res) {
                        if (res == 1) {
                            alert('Host is Enabled Successfully');
                            // location.reload();
                        } else {
                            alert('Host is Disabled Successfully');
                            // location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection
