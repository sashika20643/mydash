@extends('layouts.master')
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/') }}/api/country/store" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" name="device" value="web">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Country Name:</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Image:</label>
                            <input type="file" name="country_image" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Country</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/') }}/api/country/update" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="country_id" id="country_id">
                        <input type="hidden" name="device" id="device" value="web">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Country Name:</label>
                            <input type="text" name="country" id="edit_country" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Image:</label>
                            <input type="file" name="country_image" class="form-control">
                        </div>

                        <div class="form-group">
                            <img src="" id="view_country_img" style="height: 100px;width:100px">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">update country</button>
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

                            <h4 class="card-title">Country</h4>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2">
                                    <button type="button" id="add_country" class="btn btn-success">Add
                                        Country</button>
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
                                        <th>Flag</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($country->count() > 0)
                                        @foreach ($country->get() as $value)
                                            <tr>
                                                <td>{{ $value->country }}</td>
                                                <td><img src="{{ $value->country_img }}"
                                                        style="width: 60px;height: 60px;object-fit: cover;">
                                                </td>
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
                                            <td colspan="6" class="text-center">Country Not Found</td>
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
                url: '<?php echo url('/'); ?>/get-country-details',
                data: {
                    id: id
                },
                success: function(res) {
                    const obj = JSON.parse(res);
                    $("#country_id").val(obj.id);
                    $("#edit_country").val(obj.country);
                    document.getElementById("view_country_img").src = obj.country_img;
                }
            });
            $("#edit-modal").modal('show');
        }

        function deletes(id) {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/country/destroy',
                data: {
                    id: id,
                    device: "web"
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Country Delete Successfully');
                        location.reload();
                    }
                }
            });
        }

        $("#delete_all").click(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo url('/'); ?>/api/country/destroyAll',
                data: {
                    device: "web"
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Country Delete All Successfully');
                        location.reload();
                    }
                }
            });
        });
    </script>
@endsection
