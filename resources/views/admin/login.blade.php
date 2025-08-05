{{-- <html>
    <title>Admin Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <body>

        <div class="container">
            <div class="row">
                <div class="col-8">
                <!-- Content here -->
                <h2>Admin Login Page</h2>
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                         <li>{{ $error}}</li>
                    @endforeach
                @endif
                @if(Session::has('error'))
                    <li>{{ Session::get('error')}}</li>
                @endif
                @if(Session::has('success'))
                    <li>{{ Session::get('success')}}</li>
                @endif
                <form action="{{ route('admin.login_submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
          </div>
    </body>
</html> --}}

<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Admin Login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

        <!-- preloader css -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/preloader.min.css') }}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend/assets/css/app.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.html" class="d-block auth-logo">
                                    <img src="{{ asset('backend/assets/images/logo-sm.svg') }}" alt="" height="28"> <span class="logo-txt"> WisdomGold</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue to WDG.</p>
                                </div>

    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{$error }}</li>
    @endforeach
@endif

@if (Session::has('error'))
    <li>{{ Session::get('error') }}</li>
@endif
@if (Session::has('success'))
    <li>{{ Session::get('success') }}</li>
@endif
<form class="mt-4 pt-2" action="{{ route('admin.login_submit') }}"  method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
    </div>
    <div class="mb-3">
        <div class="d-flex align-items-start">
            <div class="flex-grow-1">
                <label class="form-label">Password</label>
            </div>
            <div class="flex-shrink-0">
                <div class="">
                    <a href="{{ route('admin.forget_password') }}" class="text-muted">Forgot password?</a>
                </div>
            </div>
        </div>

        <div class="input-group auth-pass-inputgroup">
            <input type="password" name="password"  class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
            <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="form-check">

            </div>
        </div>

    </div>
    <div class="mb-3">
        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
    </div>
</form>



                                {{-- <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">Don't have an account ? <a href="auth-register.html"
                                            class="text-primary fw-semibold"> Signup now </a> </p>
                                </div> --}}
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> WisdomGold</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                    <div class="col-xl-7">

                    </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>
        <!-- pace js -->
        <script src="{{ asset('backend/assets/libs/pace-js/pace.min.js') }}"></script>
        <!-- password addon init -->
        <script src="{{ asset('backend/assets/js/pages/pass-addon.init.js') }}"></script>

    </body>

</html>