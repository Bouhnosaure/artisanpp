<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('elements/head'); ?>
        <?php echo $map['js']; ?>
    </head>
    <body>
        <div data-role="page" id="map-page" class="ui-responsive-panel">

            <?php $this->load->view('elements/header'); ?>

            <?php echo $map['html']; ?> 
           
            <?php $this->load->view('elements/list', $artisans); ?>

            <?php $this->load->view('elements/sidebar'); ?>

            <?php $this->load->view('elements/login_panel'); ?>

        </div><!-- /page -->
        <?php $this->load->view('elements/footer'); ?>
    </body>
</html>
