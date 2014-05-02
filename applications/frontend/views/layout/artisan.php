<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('elements/head'); ?>
    </head>
    <body>
        <div data-role="page" id="map-page" class="ui-responsive-panel">
            <?php $this->load->view('elements/header'); ?>

            <div data-role="content" id="fiche-artisan" data-theme="b">
                <article class="artisan">
                    <p>Travaux Generaux</p>

                    <img src="http://us.123rf.com/400wm/400/400/pressmaster/pressmaster1106/pressmaster110600157/9725289-portrait-d-39-artisan-heureux-avec-differents-outils-dans-les-mains.jpg" alt="" class="profilPic"></>
                    <h3 align="center">NOM</h3>

                    <p align="center">53 rue de truc 33300 bordeaux</p>
                    <p>
                        <a href="tel:0616391876" class="call2action Red"><i class="fa fa-phone fa-2x"></i>Appeler</a>

                        <span class="distanceArtisan">250 mètres</span>

                    <div class="footerFicheArtisan">
                        <a href="#" class="call2action Grey"><i class="fa fa-location-arrow"></i>  Itineraire</a> 
                    </div>
                    </p>

                    <span class="blocnoteglobale">
                        <div class="noteglobaleFiche"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></div>
                        <a href="#">Noter cet artisan</a>
                    </span>

                    <span class="blocComment">
                        <a href="#" class="first">Lire Les avis (8)</a>
                        <a href="#">Laisser mon avis</a>
                    </span>
                </article>

                <?php $this->load->view('elements/sidebar'); ?>

                <?php $this->load->view('elements/login_panel'); ?>

            </div><!-- /page -->
        </div>
        <?php $this->load->view('elements/footer'); ?>
    </body>
</html>
