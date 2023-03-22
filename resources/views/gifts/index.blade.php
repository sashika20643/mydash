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
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/') }}/api/gifts/category/store" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" name="device" value="web">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Image:</label>
                            <input type="file" name="cat_image" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/') }}/api/gifts/category/update" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id">
                        <input type="hidden" name="device" id="device" value="web">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Country Name:</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Image:</label>
                            <input type="file" name="cat_image" class="form-control">
                        </div>

                        <div class="form-group">
                            <img src="" id="view_cat_img" style="height: 100px;width:100px">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">update category</button>
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

                            <h4 class="card-title">Category</h4>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2">
                                    <button type="button" id="add_country" class="btn btn-success">Add
                                        Category</button>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Is Top</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($category->count() > 0)
                                        @foreach ($category->get() as $value)
                                            <tr><td><img src="{{ $value->cat_image }}"
                                                        style="width: 60px;height: 60px;object-fit: cover;"></td>
                                                <td>
                                                    {{ $value->name }}
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="category_{{ $value->id }}"
                                                            id="category_{{ $value->id }}" value="{{ $value->id }}" @if($value->is_top == 1) checked @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <span class="ti-slice"
                                                        onclick="edit({{ $value->id }})"></span>
                                                    <span class="ti-trash"
                                                        onclick="deletes({{ $value->id }})"></span>
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
                url: '<?php echo url('/'); ?>/get-gifts-category-details',
                data: {
                    id: id
                },
                success: function(res) {
                    const obj = JSON.parse(res);
                    $("#cat_id").val(obj.id);
                    $("#edit_name").val(obj.name);
                    document.getElementById("view_cat_img").src = obj.cat_image;
                }
            });
            $("#edit-modal").modal('show');
        }

        function deletes(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/gifts/category/destroy',
                data: {
                    id: id,
                    device: "web"
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Category Delete Successfully');
                        location.reload();
                    }
                }
            });
        }

        $("#delete_all").click(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/gifts/category/destroyAll',
                data: {
                    device: "web"
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Category Delete All Successfully');
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
                        }
                        else{
                            alert('Category Down rated Successfully');
                            location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection
