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

                            <h4 class="card-title">User Details</h4>
                        </div>
                        <div class="card-body" style="overflow: scroll;">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Point</th>
                                        <th>Followers</th>
                                        <th>Following</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Created At</th>
                                        <th>Invited By</th>
                                        <th>Show History</th>
                                        <th>Notification</th>
                                        <th>Is Block</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user)
                                    @php
                                        $i=0;
                                    @endphp
                                        @foreach ($user as $value)
                                            <tr>
                                                <td>{{ $value['name'] }}</td>
                                                <td>{{ $value["phone"]}}</td>
                                                <td>{{ $value["gender"]}}</td>
                                                <td>{{ $value["dob"]}}</td>
                                                <td></td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{ $value["country"] }}</td>
                                                <td></td>
                                                {{-- <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td> --}}
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button type="button"  name="show_history" id="show_history"
                                                        class="btn btn-sm btn-success">Show History</button>
                                                </td>
+
                                                <td>
                                                        <button
                                                            type="button" name="push_notification" id="push_notification" onclick="showrate(`{{ $value['uid']}}`);"
                                                            class="btn btn-sm btn-primary">Push Notification</button>

                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        @if($status[$i]==1)
                                                        <input type="checkbox" name="isBlock" id="isBlock" checked="true"
                                                        value="{{ $value["uid"] }}" >
                                                        @elseif($status[$i]==1)
                                                        <input type="checkbox" name="isBlock" id="isBlock" disabled
                                                        value="{{ $value["uid"] }}" >
                                                        @else
                                                        <input type="checkbox" name="isBlock" id="isBlock"
                                                            value="{{ $value["uid"] }}" >
                                                            @endif
                                                        @php
                                                            $i++
                                                        @endphp
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            </tr>
{{--
<div class="container  " id="history" style="background-color:white;position:fixed;max-width:100vw;min-height:40vh;width:50vw;display:none;top:50%;left:60%;transform:translate(-50%,-50%);box-shadow:2px 2px 2px rgb(174, 212, 156.0.5);border:1px solid rgb(174, 212, 156)" >
    <div class="" style="font-size: large;font-weight:bold;color:rgb(234, 34, 34);text-align:right;cursor: pointer;" >
       <span onclick="hidehistory();"> X</span>
    </div>
    <div class="d-flex p-5 flex-column justify-content-center align-items-center"  style="width: 100%">

        <h1>Notification</h1>
{{-- <form action="{{ url('/') }}/api/user/push_notification/{{ $value["uid"] }}">


    <div class="form-group">
        <label for="exampleInputEmail1">Notification Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="title">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Notification body</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="body">
      </div>
</form>

    </div> --}}
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="14" class="text-center">User not found</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>

                            {{-- <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Point</th>
                                        <th>Followers</th>
                                        <th>Following</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Created At</th>
                                        <th>Invited By</th>
                                        <th>Show History</th>
                                        <th>Notification</th>
                                        <th>Is Block</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user->count() > 0)
                                        @foreach ($user->get() as $value)
                                            <tr>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->phone_number }}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{ $value->country }}</td>
                                                <td></td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td></td>
                                                <td>
                                                    <button type="button" name="show_history" id="show_history"
                                                        class="btn btn-sm btn-success">Show History</button>
                                                </td>

                                                <td>
                                                    <button type="button" name="show_history" id="show_history"
                                                        class="btn btn-sm btn-primary">Push Notification</button>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" checked>
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

                            </table> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>



</div>

    </div>

    <div class="pt-3" style="position: absolute;flex-direction:column;    transition-duration: 2s;
    transition-timing-function: linear;
    transition-delay: .3s;width:100vw;height:100vh;top:0;left:0;background-color:rgba(0, 0, 0, 0.8);align-items:center;justify-content:center;display:none    " id="divcont" >

    <div style="display:flex;align-items:center;justify-content:center;" >
        <form action="" method="POST" id="myDiv" >
            @csrf
            <h3 class="text-center" >Notification</h3>
    <input type="text" id="myInput" style="display: none" name="id">
    <div class="form-group">
        <label for="exampleInputEmail1">Notification Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" placeholder="title">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Notification body</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="body" placeholder="body">
      </div>
            <button type="submit" class="btn btn-success"> Send </button>
            </form>
    </div>

    </div>

    <script>
        // Get the div element
        const myDiv = document.getElementById("myDiv");
         const  pushButtons=document.querySelectorAll('button[name="push_notification"]');

        const divcont = document.getElementById("divcont");



        // Add a click event listener to the document
        document.addEventListener("click", (event) => {
          // Check if the clicked element is inside the div

          var clickedButton = event.target;
  var isPushButton = false;
  for (var i = 0; i < pushButtons.length; i++) {
    if (pushButtons[i] === clickedButton) {
      isPushButton = true;
      break;
    }
  }
          if (!myDiv.contains(event.target) && !isPushButton) {
            // If not, hide the div
            divcont.style.display = "none";
          }

        });

        function showrate(id){

            // console.log(id);
            myDiv.setAttribute("action", "{{ url('/') }}/api/user/push_notification/"+id);

            const myInput = document.getElementById("myInput");

    // Set the value of the input field
    myInput.value = id;

    divcont.style.display = "flex";



        }
      </script>
    <script>
        $("#add_country").click(function() {
            $("#exampleModal").modal('show');
        });

        // $(document).ready(function() {
        //     $('#example').DataTable();
        // });

        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
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
                    url: '<?php echo url('/'); ?>/api/user/is_block',
                    data: {
                        status: status,
                        id: id,
                        device: "web"
                    },
                    success: function(res) {
                        if (res == 1) {
                            alert('User Block Succssfully');
                            // location.reload();
                        } else {
                            alert('User Unblock Successfully');
                            // location.reload();
                        }
                    }
                })
            });
        });
    </script>

    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyBWAXo6ov0TOpJ9UNAGohaXIMdzfrGdp1E",
            authDomain: "dating-db767.firebaseapp.com",
            databaseURL: "https://XXXX.firebaseio.com",
            projectId: "dating-db767",
            storageBucket: "XXXX",
            messagingSenderId: "149361678825",
            appId: "1:149361678825:android:9ff57ad9b093ba1511d378",
            measurementId: "XXX"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging
                .requestPermission()
                .then(function() {
                    return messaging.getToken()
                })
                .then(function(token) {
                    alert(token);
                    console.log(token);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '<?php echo url('/') ?>/save-token',
                        type: 'POST',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            alert('Token saved successfully.');
                        },
                        error: function(err) {
                            console.log('User Chat Token Error' + err);
                        },
                    });

                }).catch(function(err) {
                    console.log('User Chat Token Error' + err);
                });
        }

        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: 'test',
                icon: 'dasdas',
            };
            new Notification(noteTitle, noteOptions);
        });

        function showpush(){
            $("#history").show();
        }
        function hidehistory(){
            $("#history").hide();
        }
    </script>
@endsection
