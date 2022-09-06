<div class="content-wrapper wrapper-bgcolor">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Error</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <div class="content">
    <div class="container-fluid">
      <?php display_notice(); ?>
    </div>

    <section class="content">
      <?php if ($_GET['err'] == 6): ?>
      <div class="error-page">
        <h2 class="headline text-warning mr-5">err#6</h2>
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Error 6 Encountered.</h3>
          <p>
            It seems like the system tried to release a document and forgot the tracking number, you may <a href="./">return to dashboard</a> or return, refresh, and try again!
            If this persists, call the handsome developer.
          </p>
        </div>
      </div>
      <?php elseif($_GET['err'] == 7): ?>
        <div class="error-page">
          <h2 class="headline text-warning mr-5">err#7</h2>
          <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Error 7 Encountered.</h3>
            <p>
              It seems like you tried to release a document and forgot to put the receiving unit, you may <a href="./">return to dashboard</a> or return, refresh, and try again!
              If this persists, call the handsome developer.
            </p>
          </div>
        </div>
      <?php else: ?>
        <div class="error-page">
          <h2 class="headline text-warning mr-5">error :(</h2>
          <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oh no.</h3>
            <p>
              The system encountered an unexpected error, <a href="./">return to dashboard</a> and try again!
              if this persists, call the handsome developer.
            </p>
          </div>
        </div>
      <?php endif; ?>
    </section>


  </div>
</div>