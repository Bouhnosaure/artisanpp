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
                    
                    <?php $this->load->view('widgets/geocode_statut'); ?> 
                </div>

            </div> 
        </div>
        <?php $this->load->view('elements/stats'); ?><!-- Panneau latéral droit -->
        <?php $this->load->view('elements/footer'); ?><!-- Scripts -->
    </div><!-- /page -->
</body>
</html>