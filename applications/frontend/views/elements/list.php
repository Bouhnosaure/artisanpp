<div role="main" class="ui-content ui-content-list">
    <div id="list-canvas">
        <div data-role="main" data-position="fixed" >
            <ul class="footerbox">
                <?php foreach ($artisans as $artisan): ?>
                    <li class="footerlist">
                        <div class="noteglobale"><?= $artisan->artisans_nom ?></div>
                        <a class="FooterNameArtisan" data-transition="slide"><?= $artisan->artisans_ville ?> - <?= $artisan->artisans_adresse ?></a>
                        <a class="FooterDistance" data-transition="slide">Undefined</a>
                        <a class="FooterNextArrow" data-transition="slide">#</a>
                    </li>
                <?php endforeach; ?>                                              
            </ul>
        </div>
    </div>
</div>