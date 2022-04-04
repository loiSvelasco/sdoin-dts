<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="dist/img/cropped-logo-small-192x192.png" alt="eDTS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Enhanced DTS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#modal-add-doc" class="nav-link">
                  <i class="fas fa-file-medical nav-icon"></i>
                  <p>Add Document</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?documents" class="nav-link">
                  <i class="fas fa-file-import nav-icon"></i>
                  <p>Receive / Release</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?scanrec" class="nav-link">
                  <i class="fas fa-barcode nav-icon"></i>
                  <p>Receive (Scan)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?reports" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Reports</p>
                </a>
              </li>

              <?php 
              
                if ($_SESSION['role'] == 1)
                {
                  $lala = <<<LALACUTIE
                  <li class="nav-item">
                  <a href="?admin" class="nav-link">
                    <i class="fas fa-user-cog nav-icon"></i>
                    <p>Administration</p>
                  </a>
                </li>
LALACUTIE;
                  echo $lala;
                }
                if($_SESSION['role'] == 2 || $_SESSION['role'] == 1 || $_SESSION['unit'] == 117 || $_SESSION['unit'] == 127 || $_SESSION['unit'] == 128)
                {
                  // special accounts
                  $lala = <<<LALACUTIE
                  <li class="nav-item">
                  <a href="?upload" class="nav-link">
                    <i class="fas fa-upload nav-icon"></i>
                    <p>Upload</p>
                  </a>
                </li>
LALACUTIE;
                  echo $lala;
                }

              ?>

            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>