<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('elements/head'); ?>
        <?php echo $map['js']; ?>
    </head>
    <body>
        <div data-role="page" id="map-page" class="ui-responsive-panel">

            <?php $this->load->view('elements/header'); ?>

            <div>
                Content HERE ;p
            </div>

            <?php $this->load->view('elements/sidebar'); ?>

            <?php $this->load->view('elements/login_panel'); ?>

        </div><!-- /page -->
        <?php $this->load->view('elements/footer'); ?>
    </body>
</html>
