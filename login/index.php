<!DOCTYPE html>
<html lang="zxx">


<head>
  <!-- Basic Page Needs
  ================================================== -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- For Search Engine Meta Data  -->
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="yoursite.com" />

  <title>Admin Login</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/icon" href="https://www.shareicon.net/data/256x256/2016/04/14/492851_admin_256x256.png" />

  <!-- Main structure css file -->
  <link rel="stylesheet" href="css/login3-style.css">


</head>

<body>
  <!-- Start Preloader -->
  <div id="preload-block">
    <div class="square-block"></div>
  </div>
  <!-- Preloader End -->

  <div class="container-fluid">
    <div class="row">
      <div
        class="authfy-container col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
        <div class="col-sm-5 authfy-panel-left">
          <div class="brand-col">
            <div class="headline">
              <!-- brand-logo start -->
              <div class="brand-logo">
                <img src="https://pafssh.provirtualmeeting.com/wp-content/uploads/2020/09/login.png" width="150" alt="brand-logo">
              </div><!-- ./brand-logo -->
              <p style="text-align: center;">Login using Phone Number and Password</p>

            </div>
          </div>
        </div>
        <div class="col-sm-7 authfy-panel-right">
          <!-- authfy-login start -->
          <div class="authfy-login">
            <!-- panel-login start -->
            <div class="authfy-panel panel-login text-center active">
              <div class="authfy-heading">
                <h3 class="auth-title">Login to Admin Panel</h3>

              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12">


                  <form name="loginForm" class="loginForm" action="login_action.php" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control email" name="phn" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                      <div class="pwdMask">
                        <input type="password" class="form-control password" name="user_pwd" placeholder="Password" required>
                        <span class="fa fa-eye-slash pwd-toggle"></span>
                      </div>
                    </div>
                    <!-- start remember-row -->
                    <div class="row remember-row">
                      <div class="col-xs-6 col-sm-6">
                        <label class="checkbox text-left">
                          <input type="checkbox" value="remember-me">
                          <span class="label-text">Remember me</span>
                        </label>
                      </div>
                      <div class="col-xs-6 col-sm-6">
                        <p class="forgotPwd">
                          <a class="lnk-toggler" data-panel=".panel-forgot" href="#">Forgot password?</a>
                        </p>
                      </div>
                    </div> <!-- ./remember-row -->
                    <div class="form-group">
                      <button class="btn btn-lg btn-primary btn-block" type="submit">Login with email</button>
                    </div>
                  </form>


                </div>
              </div>
            </div> <!-- ./panel-login -->

            <!-- panel-forget start -->
            <div class="authfy-panel panel-forgot">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <div class="authfy-heading">
                    <h3 class="auth-title">Recover your password</h3>
                    <p>Fill in your e-mail address below and we will send you an email with further instructions.</p>
                  </div>
                  <form name="forgetForm" class="forgetForm" action="#" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control" name="username" placeholder="Email address">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-lg btn-primary btn-block" type="submit">Recover your password</button>
                    </div>
                    <div class="form-group">
                      <a class="lnk-toggler" data-panel=".panel-login" href="#">Back to Log In</a>
                    </div>
                  </form>
                </div>
              </div>
            </div> <!-- ./panel-forgot -->
          </div> <!-- ./authfy-login -->
        </div>
      </div>
    </div> <!-- ./row -->
  </div> <!-- ./container -->

  <!-- Javascript Files -->

  <!-- initialize jQuery Library -->
  <script src="js/jquery-2.2.4.min.js"></script>

  <!-- for Bootstrap js -->
  <script src="js/bootstrap.min.js"></script>

  <!-- Custom js-->
  <script src="js/custom.js"></script>

</body>

</html>