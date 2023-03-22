<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/public/images/favicon.png') }}">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <?php
    $role = DB::table('role')
        ->where('status', 1)
        ->get();
    ?>
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Signup your account</h4>
                                    <form method="POST" action="{{ url('/') }}/api/user/store" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="device" value="web">
                                        <div class=" form-group">
                                            <label><strong>Name</strong></label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" name="username" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Phone Number</strong></label>
                                            <input type="number" name="phone_number" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Identity</strong></label>
                                            <input type="text" name="identity" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Image</strong></label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Country</strong></label>
                                            <input type="text" name="country" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>Role</strong></label>
                                            <select name="role_id" id="role_id" class="form-control">
                                                <option value="">Select Role</option>
                                                @foreach ($role as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me in</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary"
                                                href="{{ url('/') }}/">Sign
                                                In</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('/public/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('/public/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('/public/js/custom.min.js') }}"></script>

</body>

</html>
