<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('elements/head'); ?><!-- Head -->
    </head>
    <body>
        <div id="cl-wrapper">
            <?php $this->load->view('elements/sidebar'); ?><!-- SideBar -->
            <div class="container-fluid" id="pcont">
                <?php $this->load->view('elements/header'); ?><!-- Header -->

                <!--+
                    |
                    |CONTENU 
                    |
                    +-->
                <div class="cl-mcont">
                    <?php
                    $attributes = array('class' => 'dropzone', 'id' => 'dropzone');
                    echo form_open('upload/file', $attributes);
                    ?>
                </div>
            </div> 
        </div>
        <?php $this->load->view('elements/stats'); ?><!-- Panneau latéral droit -->
        <?php $this->load->view('elements/footer'); ?><!-- Scripts -->
        <script type="text/javascript">
            Dropzone.options.dropzone = {
                accept: function(file, done) {
                    console.log(file);
                    if (file.type != "application/vnd.ms-excel") {
                        done("Error! Files of this type are not accepted");
                    }
                    else {
                        done();
                    }
                }
            }
        </script>
    </div><!-- /page -->
</body>
</html>
