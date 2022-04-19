  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper wrapper-bgcolor">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Debug</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Debug</li>
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
      </div>

      <div class="row">

        <div class="col-lg-12 col-12">
          <div class="card">
            <div class="card-header bg-primary"></div>
            <div class="card-body">
            <code>
              <?php 
              $version = phpversion();
              print "Running on PHP Version: " . $version;
              ?>
              <hr>
                <div class="inline-code">
                    <code>
                    <?php 
                        echo "User: " . $_SESSION['user'] . "<br>";
                        echo "User ID: " . $_SESSION['user_id'] . "<br>";
                        echo "Unit: " . $_SESSION['unit'] . "<br>";
                    ?>
                    </code>
                </div>
              <hr>
              <?php 
                  echo '<pre>';
                  var_dump($_SESSION);
                  echo '</pre>';
                  echo '<hr>';
                  echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
              ?>
              <hr>
              <p><strong>Defined Functions:</strong></p>
              <?php 
                  $functions = get_defined_functions();
                  $functions_list = array();
                  foreach ($functions['user'] as $func) {
                          $f = new ReflectionFunction($func);
                          $args = array();
                          foreach ($f->getParameters() as $param) {
                                  $tmparg = '';
                                  if ($param->isPassedByReference()) $tmparg = '&';
                                  if ($param->isOptional()) {
                                          $tmparg = '[' . $tmparg . '$' . $param->getName() . ' = ' . $param->getDefaultValue() . ']';
                                  } else {
                                          $tmparg.= '$' . $param->getName();
                                  }
                                  $args[] = $tmparg;
                                  unset ($tmparg);
                          }
                          $functions_list[] = 'function ' . $func . ' ( ' . implode(', ', $args) . ' ) <br>' . PHP_EOL;
                  }
                  print_r($functions_list);
              ?>
              <hr>
                <?php 
                    echo '<pre>' . print_r(array_keys(get_defined_vars())) . '</pre>';
                ?>
            </code>
            </div>
          </div>
        </div>

      </div>


    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
