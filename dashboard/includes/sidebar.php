<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="dist/img/cropped-logo-small-192x192.png" alt="eDTS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Enhanced DTS</span>
    </a>

    <!-- Sidebar -->
    <?php isLapsed(); ?>
    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/blank-avatar.webp" height="160" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="?profile" class="d-block"><?= properName($_SESSION['usrname']); ?></a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Documents
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(isLapsed()): ?>
                <li class="nav-item">
                  <a href="#" data-toggle="modal" data-target="#modal-add-doc-restricted" class="nav-link">
                    <i class="fas fa-file-medical nav-icon"></i>
                    <p>Add Document</p>
                  </a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a href="#" data-toggle="modal" data-target="#modal-add-doc" class="nav-link">
                    <i class="fas fa-file-medical nav-icon"></i>
                    <p>Add Document</p>
                  </a>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a href="?documents" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Receive/Release (Tabular)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?legacy" class="nav-link">
                  <i class="fas fa-file-import nav-icon"></i>
                  <p>Receive/Release (Legacy)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?scanrec" class="nav-link">
                  <i class="fas fa-barcode nav-icon"></i>
                  <p>Receive/Release (Scan)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?myDocs" class="nav-link">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>My Documents</p>
                </a>
              </li>
              <?php 
                $specialUnits = [117, 127, 128];
                $specialRoles = [1,2];
                if(in_array($_SESSION['unit'], $specialUnits) || in_array($_SESSION['role'], $specialRoles)): 
              ?>
                <li class="nav-item">
                  <a href="?upload" class="nav-link">
                    <i class="fas fa-upload nav-icon"></i>
                    <p>Upload</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="?upForwarded" class="nav-link">
                    <i class="fas fa-share-square nav-icon"></i>
                    <p>Shared with you</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="?searchDocs" class="nav-link">
                    <i class="fas fa-search nav-icon"></i>
                    <p>Search Documents</p>
                  </a>
                </li>
              <?php endif ?>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Statistics
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?reports" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Reports</p>
                </a>
              </li>
            </ul>
          </li>

          <?php if($_SESSION['role'] == 1): ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Administration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?admin" class="nav-link">
                  <i class="fas fa-user-shield nav-icon"></i>
                  <p>Administration</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-laptop-code"></i>
              <p>
                System
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?updates" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>System Updates</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?issues" class="nav-link">
                  <i class="fas fa-code-branch nav-icon"></i>
                  <p>Issue Tracking</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Simple Link
                <span class="right badge badge-success">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
