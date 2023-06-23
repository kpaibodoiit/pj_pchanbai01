<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/register.css">
<!------ Include the above in your HEAD tag ---------->

<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            {{-- <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/> --}}
            <h3>Triệu Phú Tự Thân</h3>
            <p>Phát Triển Công Nghệ Vũ Trụ Vượt Thời Gian</p>
            <form action="{{ route('auth.showLogin') }}" method="get" enctype="multipart/form-data">
                
                <input type="submit" name="" value="Login"/>
                <h6>You are have account! Please goto Login</h6>
            </form>
        </div>
        <div class="col-md-9 register-right">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Đăng Ký Mới Một Tài Khoản</h3>
                    <div class="row register-form">
                        <div class="col-md-6">
                            <form action="{{ route('auth.register') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" value="@if(session('megName')){{session('megName')}}@endif" name="name"/>
                                    <p style="color: crimson">    
                                        @if ($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                    </p>  
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email *" value="@if(session('megEmail')){{session('megEmail')}}@endif" name="email"/>
                                    <p style="color: crimson"> 
                                        @if ($errors->has('email'))
                                            {{ $errors->first('email') }}
                                        @endif
                                    </p>  
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" value="@if(session('megPw')){{session('megPw')}}@endif" name="password"/>
                                    <p style="color: crimson"> 
                                        @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                        @endif
                                    </p>  
                                </div>
                                <div>
                                    @if(session('megEr01'))
                                        <p style="color:red">
                                        <strong>{{ session('megEr01') }}</strong>
                                        </p>
                                    @endif
                                    @if(session('megSuccess'))
                                        <p style="color:#0062cc">
                                        <strong>{{ session('megSuccess') }}</strong>
                                        </p>
                                    @endif
                                </div>
                                <input type="submit" class="btnRegister"  value="Register"/>                                      
                            </div>                                   
                        </form>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="/">Top Page</a>
                    </div>
                </div>                          
            </div>
        </div>
    </div>
</div>