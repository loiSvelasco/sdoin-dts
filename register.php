<?php include("includes/header.php"); ?>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Create an account</p>

      <?php display_notice(); ?>

      <form action="actions/register.php" method="post" oninput="password2.setCustomValidity(password2.value != password.value ? 'Passwords do not match.' : '')">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="fullname" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-control select2" placeholder="School/Unit" name="unit" required>
              <option value="" disabled selected hidden>School / Unit</option>
              <optgroup label="Division Office">
                <?php get_unit_do(); ?>
              </optgroup>
              <!-- <optgroup label="Public Schools">
                <?php get_unit_public(); ?>
              </optgroup>
              <optgroup label="Private Schools">
                <?php get_unit_private(); ?>
              </optgroup> -->
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-school"></span>
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
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="password2" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12 mb-3">
            <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="?login" class="btn btn-default btn-block text-center">I already have an account</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
  <?php include("includes/footer.php"); ?>