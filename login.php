<?php
	include_once 'td_includes.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			include_once 'html_title.php';
			include_once 'pluggin_header.php';
		?>
	</head>
	<body class="authentication-bg" ng-app="tdipllp">
		<script src="<?php echo $baseurl;?>jscontroller/signin.js"></script>
		<div class="account-pages my-5" ng-controller="signincontroller" ng-cloak >
			<div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-12 p-5">
                                        <div class="mx-auto mb-5">
                                            <!-- <a href="index.html"> -->
                                                <!-- <img src="assets/images/logo.png" alt="" height="24" /> -->
                                                <h3 class="d-inline align-middle ml-1 text-logo">Login</h3>
                                            <!-- </a> -->
                                        </div>

                                        <!-- <h6 class="h5 mb-0 mt-4">Welcome back!</h6>
                                        <p class="text-muted mt-1 mb-4">Enter your email address and password to
                                            access admin panel.</p> -->

                                        <div class="form-group">
                                            <label class="form-control-label">User Id</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="mail"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" id="email" placeholder="User Id" ng-model="userid">
                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label class="form-control-label">Password</label>
                                            <!-- <a href="pages-recoverpw.html" class="float-right text-muted text-unline-dashed ml-1">Forgot your password?</a> -->
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="lock"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" id="password"
                                                    placeholder="Enter your password" ng-model="password">
                                            </div>
                                        </div>

                                        <!-- <div class="form-group mb-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="checkbox-signin" checked>
                                                <label class="custom-control-label" for="checkbox-signin">Remember
                                                    me</label>
                                            </div>
                                        </div> -->

                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-primary btn-block" ng-click="login_user(userid,password)"> Log In
                                            </button>
                                        </div>

                                        <!-- <div class="py-3 text-center"><span class="font-size-16 font-weight-bold">Or</span></div>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="" class="btn btn-white"><i class='uil uil-google icon-google mr-2'></i>With Google</a>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="" class="btn btn-white"><i class='uil uil-facebook mr-2 icon-fb'></i>With Facebook</a>
                                            </div>
                                        </div> -->
                                    </div>
                                    <!-- <div class="col-lg-6 d-none d-md-inline-block">
                                        <div class="auth-page-sidebar">
                                            <div class="overlay"></div>
                                            <div class="auth-user-testimonial">
                                                <p class="font-size-24 font-weight-bold text-white mb-1">I simply love it!</p>
                                                <p class="lead">"It's a elegent templete. I love it very much!"</p>
                                                <p>- Admin User</p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
		</div>
	</body>
</html>