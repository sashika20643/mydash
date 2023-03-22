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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Emoji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/') }}/api/effect/emoji/store" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" name="device" value="web">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Emoji:</label>
                            <input type="file" name="emoji_img" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Emoji</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Emoji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/') }}/api/effect/emoji/update" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="emoji_id" id="emoji_id">
                        <input type="hidden" name="device" id="device" value="web">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Emoji:</label>
                            <input type="file" name="emoji_img" class="form-control" required>

                            <br>
                            <img src="" id="view_emoji_img" style="height: 100px;width:100px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">update emoji</button>
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

                            <h4 class="card-title">Emoji</h4>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2">
                                    <button type="button" id="add_country" class="btn btn-success">Add
                                        Emoji</button>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2">
                                    <button type="button" id="delete_all" class="btn btn-danger">Delete All
                                    </button>
                                </div>
                            </div>
                            <br>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Emoji</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($emoji->count() > 0)
                                        @foreach ($emoji->get() as $value)
                                            <tr>
                                                <td><img src="{{ $value->emoji_img }}"
                                                        style="width: 60px;height: 60px;object-fit: cover;"></td>

                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>

                                                <td>
                                                    <span class="ti-slice" onclick="edit({{ $value->id }})"></span>
                                                    <span class="ti-trash"
                                                        onclick="deletes({{ $value->id }})"></span>
                                                </td>

                                            </tr>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Emoji Not Found</td>
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
                url: '<?php echo url('/'); ?>/api/get-effect-emoji-details',
                data: {
                    id: id
                },
                success: function(res) {
                    const obj = JSON.parse(res);
                    $("#emoji_id").val(obj.id);
                    document.getElementById("view_emoji_img").src = obj.emoji_img;
                }
            });
            $("#edit-modal").modal('show');
        }

        function deletes(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/effect/emoji/destroy',
                data: {
                    id: id,
                    device: "web"
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Emoji Delete Successfully');
                        location.reload();
                    }
                }
            });
        }

        $("#delete_all").click(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/effect/emoji/destroyAll',
                data: {
                    device: "web"
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Emoji Delete All Successfully');
                        location.reload();
                    }
                }
            });
        });

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
                    url: '<?php echo url('/'); ?>/api/gifts/category/isTopToggle',
                    data: {
                        status: status,
                        id: id,
                        device: "web"
                    },
                    success: function(res) {
                        if (res == 1) {
                            alert('Category Top rated Successfully');
                            location.reload();
                        } else {
                            alert('Category Down rated Successfully');
                            location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection
