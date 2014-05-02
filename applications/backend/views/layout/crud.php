<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('elements/head'); ?><!-- Head -->
        
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
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
                <div class="cl-mcont" style="overflow-y : scroll;">
                    <div class="block-flat">
                        <div class="header">							
                            <h3><?=$name?></h3>
                        </div>
                        <div class="content">
                            <?php echo $output; ?>
                        </div>
                    </div>
                </div> 
            </div>
            <?php $this->load->view('elements/stats'); ?><!-- Panneau latéral droit -->
            <?php $this->load->view('elements/footer'); ?><!-- Scripts -->
        </div><!-- /page -->
    </body>
</html>
