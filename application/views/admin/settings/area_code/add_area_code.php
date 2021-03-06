<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>

    <hr/>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Add Area Code<br>
                    </div>
                    <br>
                </div>
                <div class="panel-body">
                    <?php if ($this->session->flashdata('success_msg')) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong><?= $this->session->flashdata('success_msg'); ?></strong>
                                </div>
                            </div>
                        </div>
                    <?php }if($this->session->flashdata('error_msg')){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong><?= $this->session->flashdata('error_msg'); ?></strong>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <form role="form" action="<?= site_url('settings/area_code_add_post') ?>"
                          class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" required id="name" name="name"
                                       placeholder="Area Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="area_code" class="col-sm-3 control-label">Area Code</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" required id="area_code" name="area_code"
                                       placeholder="Enter Area Code">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location" class="col-sm-3 control-label">Area Location</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" required id="location" name="location"
                                       placeholder="Area Location" value="Dhaka Metropolitan City">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-5">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>


        </div>
    </div>

    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
</div>