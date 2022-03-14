<?php include("includes/header.php"); ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Enter your email below and we'll send you steps on how to recover your account.</p>

      <form action="recover-password.html" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="?login" class="btn btn-default btn-block">Login</a>
      <a href="?register" class="btn btn-default btn-block">Create an account</a>
    </div>
    <!-- /.login-card-body -->
  </div>
<?php include("includes/footer.php"); ?>