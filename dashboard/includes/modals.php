<div class="modal fade" id="modal-add-doc" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Document</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!-- form here-->
            <form action="actions/add-document.php" method="post" id="addDoc">
            <input type="hidden" name="owner" id="owner" value="<?php echo $_SESSION['user_id']; ?>" required>
            <input type="hidden" name="origin" id="origin" value="<?php echo $_SESSION['unit']; ?>" required>
            <div class="form-group row">
                <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-file"></i>
                    </div>
                    </div> 
                    <input id="doc_title" name="doc-title" placeholder="Document Title" type="text" class="form-control" required="required">
                </div>
                </div>
            </div>
            <input type="hidden" name="referer" value="<?php echo $_SERVER['REQUEST_URI'];?> ">
            <div class="form-group row">
                <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-comment"></i>
                    </div>
                    </div> 
                    <input id="doc_desc" name="doc-desc" placeholder="Description (Optional)" type="text" class="form-control">
                </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-list"></i>
                        </div>
                        </div> 
                        <select id="doc_type" name="doc-type" class="custom-select" required>
                            <option value="" disabled selected hidden>Document type</option>
                            <?php get_doctypes(); ?>
                        </select>
                        <!-- <input type="text" list="doc_type" name="doc-type" class="custom-select" required>
                        <datalist id="doc_type">
                            <option value="" disabled selected hidden>Document type</option>
                            <?php get_doctypes(); ?>
                        </datalist> -->
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-reply"></i>
                        </div>
                        </div> 
                        <select id="doc_to" name="doc-to" class="custom-select" required>
                            <option value="" disabled selected hidden>Release to</option>
                            <optgroup label="Division Office">
                                <?php get_unit_do(); ?>
                            </optgroup>
                            <optgroup label="Public Schools">
                                <?php get_unit_public(); ?>
                            </optgroup>
                            <optgroup label="Private Schools">
                                <?php get_unit_private(); ?>
                            </optgroup>
                        </select>
                        <!-- <input type="text" name="to" list="docto" class="form-control">
                        <datalist id="docto">
                            <?php
                                get_unit_do();
                                get_unit_public();
                                get_unit_private(); 
                            ?>
                        </datalist> -->
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                <textarea id="remarks" name="doc-remarks" placeholder="Remarks / Actions to be taken" cols="40" rows="5" class="form-control"></textarea>
                </div>
            </div> 
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <!-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Cancel</button> -->
            <button type="submit" form="addDoc" class="btn btn-block btn-outline-success" name="add-document"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Document</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-release-doc" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-release-doc-Label">Release Document to</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!-- form here-->
            <form method="get" id="releaseto">
                
                <input type="hidden" name="manipulate" value="release">
                <input type="hidden" name="tracking" id="doc_tracking" value="">
                <input type="hidden" name="unit" value="<?php echo $_SESSION['unit']; ?>">
                <input type="hidden" name="refer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                

                <div class="form-group row">
                    <div class="col-12">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="forPersonnel" class="custom-control-input" id="forPersonnel" value="1">
                            <label class="custom-control-label" for="forPersonnel">Release to personnel under the same unit.</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-reply"></i>
                                </div>
                            </div>
                            <select id="toUnit" name="to" class="custom-select">
                                <option value="" disabled selected hidden>Release to</option>
                                <optgroup label="Division Office">
                                    <?php get_unit_do(); ?>
                                </optgroup>
                                <optgroup label="Public Schools">
                                    <?php get_unit_public(); ?>
                                </optgroup>
                                <optgroup label="Private Schools">
                                    <?php get_unit_private(); ?>
                                </optgroup>
                            </select>
                            <select id="toPersonnel" name="toPersonnel" class="custom-select">
                                <option value="" disabled selected hidden>Select Personnel</option>
                                <optgroup label="<?php echo current_unit(); ?>">
                                    <?php get_personnel_from_unit(); ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <textarea id="rel-remarks" name="rel-remarks" placeholder="Remarks (Optional)" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                </div> 
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <!-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Cancel</button> -->
            <button type="submit" form="releaseto" class="btn btn-block btn-outline-success"><i class="fas fa-reply"></i>&nbsp;&nbsp;Release</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-release-multi-doc" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-release-doc-Label">Release Document to</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <input type="hidden" form="release" name="manipulate" value="release">
            <input type="hidden" form="release" name="tracking" id="doc_tracking" value="">
            <input type="hidden" form="release" name="unit" value="<?php echo $_SESSION['unit']; ?>">

            <div class="form-group row">
                <div class="col-12">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" form="release" name="forPersonnelMulti" class="custom-control-input" id="forPersonnelMulti" value="1">
                        <label class="custom-control-label" for="forPersonnelMulti">Release to personnel under the same unit.</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-reply"></i>
                            </div>
                        </div>
                        <select id="toUnitMulti" name="to" class="custom-select" form="release">
                            <option value="" disabled selected hidden>Release to</option>
                            <optgroup label="Division Office">
                                <?php get_unit_do(); ?>
                            </optgroup>
                            <optgroup label="Public Schools">
                                <?php get_unit_public(); ?>
                            </optgroup>
                            <optgroup label="Private Schools">
                                <?php get_unit_private(); ?>
                            </optgroup>
                        </select>
                        <select id="toPersonnelMulti" name="toPersonnelMulti" form="release" class="custom-select">
                            <option value="" disabled selected hidden>Select Personnel</option>
                            <optgroup label="<?php echo current_unit(); ?>">
                                <?php get_personnel_from_unit(); ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-12">
                        <textarea form="release" id="rel-remarks-multi" name="rel-remarks" placeholder="Remarks (Optional)" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                </div> 
        </div>
        <div class="modal-footer justify-content-between">
            <button type="submit" form="release" class="btn btn-block btn-outline-success"><i class="fas fa-reply"></i>&nbsp;&nbsp;Release</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-track" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-release-doc-Label">Track Document</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">


        <div class="stepper d-flex flex-column mt-2 ml-2">
            <div class="d-flex mb-1">
            <div class="d-flex flex-column pr-4 align-items-center">
                <div class="rounded-circle py-2 px-3 bg-secondary text-white mb-1">1</div>
                <div class="line h-100"></div>
            </div>
            <div>
                <h5 class="text-dark">Create your application respository</h5>
                <p class="lead text-muted pb-3">Choose your website name & create repository</p>
            </div>
            </div>
            <div class="d-flex mb-1">
            <div class="d-flex flex-column pr-4 align-items-center">
                <div class="rounded-circle py-2 px-3 bg-secondary text-white mb-1">2</div>
                <div class="line h-100"></div>
            </div>
            <div>
                <h5 class="text-dark">Clone application respository</h5>
                <p class="lead text-muted pb-3">Go to your dashboard and clone Git respository from the url in the dashboard of your application</p>
            </div>
            </div>
            <div class="d-flex mb-1">
            <div class="d-flex flex-column pr-4 align-items-center">
                <div class="rounded-circle py-2 px-3 bg-secondary text-white mb-1">3</div>
                <div class="line h-100 d-none"></div>
            </div>
            <div>
                <h5 class="text-dark">Make changes and push!</h5>
                <p class="lead text-muted pb-3">Now make changes to your application source code, test it then commit &amp; push</p>
            </div>
            </div>
        </div>


        </div>
        <div class="modal-footer justify-content-between">
            <!-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Cancel</button> -->
            <button type="submit" form="release" class="btn btn-block btn-outline-success" name="rel-multiple"><i class="fas fa-reply"></i>&nbsp;&nbsp;Release</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="complete-doc" tabindex="-1" role="dialog" aria-labelledby="LOIPOGI" aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title" id="LOIPOGI">Mark document as accomplished?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        
            <div class="modal-body text-justify">
                <p>You are about to mark a document as accomplished, this procedure is irreversible.</p>
                <p>You will no longer be able to release this document from the system.</p>
                <p>Do you wish to proceed?</p>
                <p class="debug-url"></p>
                
                <form method="get" id="accomp-remarks">
                    <input type="hidden" name="manipulate" id="acc_manipulate" required>
                    <input type="hidden" name="tracking" id="acc_tracking" required>
                    <input type="hidden" name="refer" id="acc_refer" required>
                    <div class="form-group row">
                        <div class="col-12">
                            <textarea id="doc-accomp" name="accomp-remarks" placeholder="Remarks / Actions taken to accomplish (Required)" cols="40" rows="5" class="form-control" required></textarea>
                        </div>
                    </div> 
                </form>

            </div>            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <!-- <a class="btn btn-success btn-ok">Accomplish Document</a> -->
                <button type="submit" class="btn btn-success" form="accomp-remarks">Accomplish</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="purge-doc" tabindex="-1" role="dialog" aria-labelledby="LOIPOGI" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title" id="LOIPOGI">Purge document?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        
            <div class="modal-body text-justify">
                <p>You are about to purge a document.</p>
                <p>Purging the document shall only be done when the document cannot be released.</p>
                <p>This will then allow the unit with the said document to add or create new documents.</p>
                <p>Do you wish to proceed?</p>
                <code>Debug URL:<p class="debug-url"></p></code>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger text-white btn-ok">Purge Document</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-doc-restricted" tabindex="-1" role="dialog" aria-labelledby="LOIPOGI" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title" id="LOIPOGI">Sorry!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        
            <div class="modal-body text-justify">
                <p>You are unable to add documents at this moment.</p>
                <p>This happens when you have unreleased / unaccomplished documents for more than 15 days. Accomplish them first to regain access on adding documents.</p>
                <p>Please check your <a href="./?reports">reports</a> page to see the concerned documents.</p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modify-user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="LOIPOGI" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title" id="LOIPOGI">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        
            <div class="modal-body text-justify">
                <form action="actions/modifyUser.php" method="post">
                    <input type="hidden" class="form-control" placeholder="ID" id="userID" name="userID" required>
                    <input type="hidden" name="referer" value="<?php echo URI; ?>">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" id="userFname" name="fullname" required autofocus>
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" id="userMail" name="email" required>
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control select2" placeholder="School/Unit" id="userUnit" name="unit" required>
                            <option value="" disabled selected hidden>School / Unit</option>
                            <optgroup label="Division Office">
                            <?php get_unit_do(); ?>
                            </optgroup>
                            <optgroup label="Public Schools">
                            <?php get_unit_public(); ?>
                            </optgroup>
                            <optgroup label="Private Schools">
                            <?php get_unit_private(); ?>
                            </optgroup>
                        </select>
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-school"></span>
                        </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control select2" placeholder="Role" id="userRole" name="role" required>
                            <option value="" disabled selected hidden>Role</option>
                            <option value="1">Administrator</option>
                            <option value="2">Special Access</option>
                            <option value="3">Regular User</option>
                        </select>
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-shield"></span>
                        </div>
                        </div>
                    </div>
                    <?php ?>
                    <div class="row">
                        <div class="d-flex justify-content-center col-12 mb-3">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="lockacct" class="custom-control-input" value="0">
                                <input type="checkbox" name="lockacct" class="custom-control-input" id="locked" value="1">
                                <label class="custom-control-label" for="locked">Lock account</label>
                            </div>
                        </div>
                    </div>
                    <?php ?>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12 mb-3">
                        <button type="submit" class="btn btn-success btn-block" name="register"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Update User</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="wordleLeaderboard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-0">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel">Wordle Leaderboard</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Leaderboard under construction. 😁
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="wordleHowToPlay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-0">
      <div class="modal-header border-0">
        <!-- <h5 class="modal-title" id="exampleModalLabel">How to Play Wordle</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <b style="align-self: center; font-size: 17px;">HOW TO PLAY</b> -->
            <!-- <br> -->
            <span>Guess the <b>WORDLE</b> in 6 attempts.</span>
            <br>
            <span>Each guess must be a valid 5 letter word. Hit the Enter button to submit an attempt.</span>
            <br>
            <span>After each guess, the color of the tiles will change to show how close your guess was to the word.</span>
            <br>
            <br>
            <div class="line-sep"></div>
            <br>
            <b>Examples</b>
            <div style="display: flex;" class="letters-example">
                <div style="background: #6AAA64; border-color: #6AAA64;">W</div>
                <div>E</div>
                <div>A</div>
                <div>R</div>
                <div>Y</div>
            </div>
            <span>The letter W is in the word and in the correct spot.</span>
            <div style="display: flex;" class="letters-example">
                <div>P</div>
                <div style="background: #C9B458; border-color: #C9B458;">I</div>
                <div>L</div>
                <div>L</div>
                <div>S</div>
            </div>
            <span>The letter I is in the word but in the wrong spot.</span>
            <div style="display: flex;" class="letters-example">
                <div>V</div>
                <div>A</div>
                <div>G</div>
                <div style="background: #787C7E; border-color: #787C7E;">U</div>
                <div>E</div>
            </div>
            <span>The letter U is not in the word in any spot.</span>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>