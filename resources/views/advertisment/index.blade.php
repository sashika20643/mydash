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

    {{-- edit modal --}}
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Advertisment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/') }}/api/advertisment/update" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="ad_id" id="ad_id">
                        <input type="hidden" name="device" id="device" value="web">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">INTERSITIAL ID:</label>
                            <input type="text" name="intersitial_id" id="intersitial_id" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">REWARD ID:</label>
                            <input type="text" name="reward_id" id="reward_id" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">NATIVE ID:</label>
                            <input type="text" name="native_id" id="native_id" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Advertisment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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



            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title">Advertisment</h4>

                        </div>
                        <div class="card-body">

                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Intersitial ID</th>
                                        <th>Reward ID</th>
                                        <th>Native ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($advertisment->count() > 0)
                                        @foreach ($advertisment->get() as $value)
                                            <tr>
                                                <td>
                                                    {{ $value->title }}
                                                </td>
                                                <td>
                                                    {{ $value->intersitial_id }}
                                                </td>
                                                <td>
                                                    {{ $value->reward_id }}
                                                </td>
                                                <td>
                                                    {{ $value->native_id }}
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ad_{{ $value->id }}"
                                                            id="ad_{{ $value->id }}" value="{{ $value->id }}"
                                                            @if ($value->is_active == 1) checked @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <span class="ti-slice" onclick="edit({{ $value->id }})"></span>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Category Not Found</td>
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
        $("#add_country").click(function() {
            $("#exampleModal").modal('show');
        });

        $(document).ready(function() {
            $('#example').DataTable();
        });


        function edit(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/get-advertisment-details',
                data: {
                    id: id
                },
                success: function(res) {
                    const obj = JSON.parse(res);
                    alert(obj.title)
                    $("#title").val(obj.title);
                    $("#intersitial_id").val(obj.intersitial_id);
                    $("#reward_id").val(obj.reward_id);
                    $("#native_id").val(obj.native_id);
                    $("#ad_id").val(obj.id);
                }
            });
            $("#edit-modal").modal('show');
        }

        $(document).ready(function() {
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
                    url: '<?php echo url('/'); ?>/api/advertisment/is_active/',
                    data: {
                        status: status,
                        id: id,
                        device: "web"
                    },
                    success: function(res) {
                        if (res == 1) {
                            alert('Active Successfully');
                            location.reload();
                        } else {
                            alert('Unactive Successfully');
                            location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection
