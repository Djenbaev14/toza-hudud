<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from zoyothemes.com/tapeli/html/auth-login by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Oct 2024 16:04:08 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

        <meta charset="utf-8" />
        <title>Логин</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}">

        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>

    <body class="bg-white">
        <div class="account-page">
            <div class="container-fluid p-0">
                <div class="row align-items-center g-0 justify-content-center">
                    <div class="col-xl-5">
                        <div class="row">
                            <div class="col-md-7 mx-auto">
                                <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                                    <div class="mb-4 p-0">
                                        <img src="{{asset('assets/images/logo.png')}}" alt="logo-dark" class="mx-auto" height="40" />
                                    </div>
    
                                    <div class="pt-0">
                                        <form action="{{route('auth.login')}}" class="my-4" method="POST">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="login" class="form-label">Логин</label>
                                                <input class="form-control" type="login" value="{{old('login')}}" id="login" name="login" placeholder="Введите логин">
                                                @if($errors->has('login'))
                                                    <div class="error text-danger">{{ $errors->first('login') }}</div>
                                                @endif
                                            </div>
                
                                            <div class="form-group mb-3">
                                                <label for="password" class="form-label">Парол</label>
                                                <div class="input-group">
                                                    <input type="password" id="password" value="{{old('password')}}" class="form-control" name="password" placeholder="Введите парол">
                                                    <button class="btn btn-outline-success" type="button" id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                @if($errors->has('password'))
                                                    <div class="error text-danger">{{ $errors->first('password') }}</div>
                                                @endif
                                            </div>
                                            
                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-success" type="submit"> Войти </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
    

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
        
        <!-- END wrapper -->

        @include('sweetalert::alert')
        <!-- Vendor -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>

        <!-- App js-->
        <script src="{{asset('assets/js/app.js')}}"></script>
        
        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                let passwordInput = document.getElementById('password');
                let icon = this.querySelector('i');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        </script>
    </body>

<!-- Mirrored from zoyothemes.com/tapeli/html/auth-login by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Oct 2024 16:04:08 GMT -->
</html>