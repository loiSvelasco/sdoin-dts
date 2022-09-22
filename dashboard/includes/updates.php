<div class="content-wrapper wrapper-bgcolor">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">System Updates</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">System Updates</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <div class="content">
    <div class="container-fluid">
      <?php display_notice(); ?>
    </div>

    <blockquote class="quote-info">
      This page contains updated information on the system. This page <i>may</i> also contain jokes.
    </blockquote>

    <section class="content">

    <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-dark">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.8-beta.6</span></strong> <span class="text-muted">Sept. 20, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Converted 2 tables to server-side processing, 10 more tables to go!<br>
                &#12288;2. The end of the world is imminent.<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.7-beta.6</span></strong> <span class="text-muted">Sept. 20, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Converted 4 tables to server-side processing, 12 more tables to go!<br>
                &#12288;&#12288;&#12288;&#12288;Specifically, the received and released table on the reports page. Next to work on is the receiving and releasing table when on tabular and scan mode.
                <br>
                &#12288;2. Sprayed insecticide to remove bugs, but some may still be hidden. (and will soon multiply too!) 🐛🐜<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.6-beta.6</span></strong> <span class="text-muted">Sept. 18, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Converted 2 tables to server-side processing, 16 more tables to go!<br>
                &#12288;&#12288;&#12288;&#12288;Details for those curious: Tables load client-side (your computer / browser), which means downloading all the data (document details, locations, owners, etc.) 
                from the server (this system's database) and displaying it on your browser. However, imagine having to download ~1,000,000 rows of data through years of usage and display it to a table, it would take a significant amount of time.
                The solution is server-side processing, this allows asynchronous fetching of data in the bacgkround rather than having to load 1 million rows of data at page load. This breaks the downloading part into smaller 
                parts (i.e. download 10 or 20 or 30 rows now, and when the user clicks on the next page of the table, download the next 10, 20, or 30 rows.). The conversion of tables from client-side to server-side will take a while 
                since I do it alone, but it will be done to increase the system's performance in the long run.
                <br>
                &#12288;2. Prohibited editing of document location when already received.<br>
                &#12288;3. Sprayed insecticide to remove bugs, but some may still be hidden. (and will soon multiply too!) 🐛🐜<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.6-beta.5</span></strong> <span class="text-muted">Sept. 13, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Fixed bugs when on legacy mode.<br>
                &#12288;2. Added file hashing for cache management.<br>
                &#12288;3. Added more bugs to be fixed later. 🐛🐜<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.0-beta.5</span></strong> <span class="text-muted">Sept. 12, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Disabled form submit buttons when releasing to avoid duplicates for users with slow internet.<br>
                &#12288;2. Dynamically generate PNG barcode upon document creation and tracking for ease of printing. 🎉<br>
                &#12288;3. Rebuilt some (<i>a lot, actually</i>) codes from scratch to further decrease loadtimes for administrator accounts that handles a lot of data.<br>
                &#12288;4. Tracking nos are now clickable on receiving / releasing (Tabular mode) for ease of tracking.<br>
                &#12288;5. Added more bugs to be fixed later. 🐛🐜<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.0-beta.4</span></strong> <span class="text-muted">Sept. 07, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Added legacy support for releasing and receiving.<br>
                &#12288;2. Alphabetically arranged names for releasing under the same unit.<br>
                &#12288;3. Added error codes for ease of issue tracking.<br>
                &#12288;4. Fixed a bug where checked items on other pages of receiving/releasing table are not being received/released.<br>
                &#12288;5. Paginated releasing and receiving tables when on tabular mode.<br>
                &#12288;6. Added a print button when tracking. For ease of printing for documents which are necessary to have the same tracking no.<br>
                &#12288;7. Improved sorting of releasing and receiving table as follows:<br>
                &#12288;&#12288;&#12288;&#12288;7.1. Receiving table is sorted by date in the order of <mark><i>Oldest to Newest</i></mark>, hence, newer documents will be located at the end of the list / table.<br>
                &#12288;&#12288;&#12288;&#12288;7.2. Releasing table is sorted by date in the order of <mark><i>Newest to Oldest</i></mark>, hence, newer documents will be located at the top of the list / table.<br>
                &#12288;8. Added a script to force redownload <i>some</i> system files to keep the system updated across all computers around the world. 😂<br>
                &#12288;9. Added more bugs to be fixed later. 🐛🐜<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.0-beta.3</span></strong> <span class="text-muted">Sept. 04, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Made the top navigation bar darker, like my soul.<br>
                &#12288;2. Categorized the side navigation bar by type for clarity.<br>
                &#12288;3. Added the ability to edit your <mark><i>own</i></mark> documents.<br>
                &#12288;4. Defeated the Earth Dragon Azhdaha, Overlord of the Geovishaps. 😈<br>
                &#12288;5. Various improvements.<br>
                &#12288;5. Started work on profile editing. (with profile pictures maybe?)<br>
                &#12288;7. Added more bugs to be fixed later. 🐛🐜<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.9.0-beta.1</span></strong> <span class="text-muted">Aug. 29, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Adjusted database and made corrections to timestamps, documents created from August 8 to 28 may display wrong timestamps on released / received.<br>
                &#12288;2. Improved performance for launching on Sept. 5, 2022.<br>
                &#12288;3. Started work on issue reporting, for easier suggestions / error reporting. <br>
                &#12288;4. Categorized schools on registration page for faster searching (Elem, Sec, Integrated). <br>
                &#12288;5. Added more errors to be fixed later. 🤪🥴<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.8.0-beta.9</span></strong> <span class="text-muted">Aug. 20, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Added the ability to input remarks when releasing a document. - for multiple releases<br>
                &#12288;2. Implemented the ability to release documents under the same unit (to a specific personnel under the unit).<br>
                &#12288;3. Re-written some functions for efficiency and <i>hopefully</i> decreases loadtimes.<br>
                &#12288;4. Added more errors to be fixed later. 🤪🥴<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.8.0-beta.7</span></strong> <span class="text-muted">Aug. 13, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Added the ability to input remarks when releasing a document.<br>
                &#12288;2. Made the <mark>Track</mark> textbox located at the navigation bar larger.<br>
                &#12288;3. Removed the log-out timer.<br>
                &#12288;4. Added more document types.<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-monospace">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-light">
              <strong>System updated to <span class="badge badge-warning rounded-0">2.8.0-beta.3</span></strong> <span class="text-muted">Aug. 10, 2022</span>
            </div>
            <div class="card-body">
              <h5 class="card-title">Changelog:</h5>
              <p class="card-text">
                <hr>
                &#12288;1. Automatically log out after <mark><i>25 minutes</i></mark> of inactivity.<br>
                &#12288;2. Displayed current location within <mark><i>All created documents</i></mark> table found in <mark><i>Reports</i></mark> page.<br>
                &#12288;3. Adjusted the layout to adapt when viewing the system on mobile.<br>
                &#12288;4. Fixed an error where accomplishments are displayed across all units when generating by date range.<br>
                &#12288;5. Added this - <mark><i>updates</i></mark> page, to inform users on changes when needed.<br>
              </p>
              <p class="text-left"><strong>- Louis V.</strong></p>
            </div>
          </div>
        </div>
      </div>

    </section>


  </div>
</div>