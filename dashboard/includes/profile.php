  <?php 
    $get_img = query("SELECT ud_img FROM user_details WHERE id = {$userID}");
    confirm($get_img);
    $row = fetch_assoc($get_img);
    $imgName = $row['ud_img'];

    function getMyCreatedDocs()
    {
      $query = query("SELECT COUNT(*) AS total FROM documents WHERE document_owner = {$_SESSION['user_id']} ");
      confirm($query);
      $row = fetch_assoc($query);
      echo shortNumber($row['total']);
    }

  ?>
  <style>
    .profile-image {
        position: relative;
        width: 200px;
        border-radius: 50%;
    }

    .pfpimage {
        opacity: 1;
        display: block;
        width: 200px;
        height: 200px;
        object-fit: cover;
        transition: .1s ease;
        backface-visibility: hidden;
    }

    .top-right {
        transition: .1s ease;
        opacity: 0;
        position: absolute;
        bottom: 0%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .profile-image:hover .image {
        opacity: 0.4;
    }

    .profile-image:hover .top-right {
        opacity: 1;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <?php display_notice();?>

      <div class="row">
        <div class="col-lg-4 col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                    <div class="profile-image mx-auto">
                      <?php if($imgName != ''): ?>
                        <img src="uploads/<?=$imgName?>"
                            alt="Profile Image" 
                            class="pfpimage profile-user-img img-fluid img-circle" 
                            width="200" 
                            height="200">
                        <div class="top-right">
                            <a class="text-dark" href="" data-toggle="tooltip" data-placement="bottom" title="Remove photo"><i class="fas fa-trash"></i></a>
                        </div>
                      <?php else: ?>
                        <img src="dist/img/blank-avatar.webp"
                            alt="Profile Image" 
                            class="pfpimage profile-user-img img-fluid img-circle" 
                            width="200" 
                            height="200">
                      <?php endif; ?>
                    </div>
              </div>
              <p class="h3 profile-username text-center mb-0 mt-4"><?= $userFullName ?></p>
              <p class="text-muted text-center"><?= $userEmail ?></p>
            </div>
            <div class="card-footer border-0">
              <div class="mt-2">
                <form action="actions/updateprofile.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="referer" value="<?php echo BASE_HOST.URI; ?>">
                  <div class="input-group mb-3">
                    <p>Profile Image&nbsp;&nbsp;&nbsp;</p>
                    <input class="file-input" type="file" name="pfimage">
                    <small><strong>Accepted filetypes are: JPG, PNG, GIF. Max Filesize is 2MB.</strong></small>
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full Name" value="<?= $userFullName ?>"
                      name="fullName"
                      required>
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="E-mail Address" value="<?= $userEmail ?>"
                      name="userEmail"
                      required>
                  </div>
                  <button type="submit" name="updateProfile" class="btn btn-primary rounded-0 btn-block"><i
                      class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Update Profile Details</button>
                </form>
              </div>
              <hr>
              <div class="mt-2">
                <p>Change Password</p>
                <form action="actions/changepwd.php" method="post"
                  oninput="newPass1.setCustomValidity(newPass1.value != newPass.value ? 'Passwords do not match.' : '')">
                  <input type="hidden" name="referer" value="<?php echo BASE_HOST.URI; ?>">
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Current Password"
                      aria-label="Sizing example input" name="currPass" aria-describedby="inputGroup-sizing-default"
                      required>
                  </div>
                  <hr>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="New Password"
                      aria-label="Sizing example input" name="newPass" aria-describedby="inputGroup-sizing-default"
                      required>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password"
                      aria-label="Sizing example input" name="newPass1" aria-describedby="inputGroup-sizing-default"
                      required>
                  </div>
                  <button type="submit" name="changePass" class="btn btn-success rounded-0 btn-block"><i
                      class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;Update Password</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <div class="ml-1">
                <h1 class="display-4"><?= $greeting ?> <?= $user ?>,</h1>
                <p class="lead">Here are your overall stats:</p>
              </div>
              <div class="ml-1">
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="card rounded-0">
                      <div class="card-body">
                        <h5 class="card-title mb-4"><strong>Documents Created</strong></h5>
                        <p class="card-text h3"></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="card rounded-0">
                      <div class="card-body">
                        <h5 class="card-title mb-4"><strong>Documents Received</strong></h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="card rounded-0">
                      <div class="card-body">
                        <h5 class="card-title mb-4"><strong>Documents Released</strong></h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="card rounded-0">
                      <div class="card-body">
                        <h5 class="card-title mb-4"><strong>Documents Accomplished</strong></h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


        <div class="row">
          <div class="col-12">
            
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
