<?php include("includes/header.php"); ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form action="actions/recover.php" method="post" oninput="password2.setCustomValidity(password2.value != password.value ? 'Passwords do not match.' : '')">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="password2" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <input type="hidden" name="hash" value="<?php echo escape_string($_GET['hash']); ?>">
        <input type="hidden" name="email" value="<?php echo escape_string($_GET['for']); ?>">

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="recover">Set as new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <p class="mt-3 mb-1">
        <a href="?login" class="btn btn-default btn-block">Login</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
  <?php include("includes/footer.php"); ?>