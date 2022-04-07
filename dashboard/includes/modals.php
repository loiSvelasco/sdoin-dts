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
                    <input id="doc_desc" name="doc-desc" placeholder="Description" type="text" class="form-control" required="required">
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
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                <textarea id="remarks" name="doc-remarks" placeholder="Purpose" cols="40" rows="5" class="form-control" required="required"></textarea>
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
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-reply"></i>
                                </div>
                            </div>
                            <select id="doc_to" name="to" class="custom-select" required>
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
                                <?php // get_unit_do(); ?>
                                <?php // get_unit_public(); ?>
                                <?php // get_unit_private(); ?>
                            </datalist> -->
                        </div>
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
            <!-- form here-->                
                <input type="hidden" form="release" name="manipulate" value="release">
                <input type="hidden" form="release" name="tracking" id="doc_tracking" value="">
                <input type="hidden" form="release" name="unit" value="<?php echo $_SESSION['unit']; ?>">
                
                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-reply"></i>
                                </div>
                            </div>
                            <select id="doc_to" name="to" class="custom-select" form="release" required>
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
                                <?php // get_unit_do(); ?>
                                <?php // get_unit_public(); ?>
                                <?php // get_unit_private(); ?>
                            </datalist> -->
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title" id="LOIPOGI">Mark document as accomplished?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        
            <div class="modal-body text-justify">
                <p>You are about to mark a document as accomplished, this procedure is irreversible.</p>
                <p>You will no longer be able to release this document from the system.</p>
                <p>Do you wish to proceed?</p>
                <!-- <p class="debug-url"></p> -->
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success btn-ok">Accomplish Document</a>
            </div>
        </div>
    </div>
</div>