<?php include("includes/header.php");
if(isset($_SESSION['user']))
{
  redirect("./dashboard");
}

?>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign In</p>

      <?php display_notice(); ?>

      <form action="actions/login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <a href="?forgot" class="btn btn-default btn-block">I forgot my password</a>
      <a href="?register" class="btn btn-default btn-block">Create an account</a>
    </div>
    <!-- /.login-card-body -->
  </div>

<!-- /.login-box -->
<?php include("includes/footer.php"); ?>
