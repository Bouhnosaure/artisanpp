<div class="cl-sidebar">
    <div class="cl-toggle"><i class="fa fa-bars"></i></div>
    <div class="cl-navblock">
        <div class="menu-space">
            <div class="content">

                <!-- LOGO -->
                <div class="sidebar-logo">
                    <div class="logo">
                        <a href="index2.html"></a>
                    </div>
                </div>

                <!-- PHOTO + STAT -->
                <div class="side-user">
                    <div class="avatar"><img src="<?= $GLOBALS['adminroot'] ?>assets/images/avatar6.jpg" alt="Avatar" /></div>
                    <div class="info">
                        <p>40 <b>GB</b> / 100 <b>GB</b><span><a href="#"><i class="fa fa-plus"></i></a></span></p>
                        <div class="progress progress-user">
                            <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">50% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MENU -->
                <ul class="cl-vnavigation">

                    <li><?= anchor('home', '<i class="fa fa-home"></i><span>Dashboard</span>') ?></li>
                    <li><?= anchor('upload', '<i class="fa fa-smile-o"></i><span>Upload</span>') ?></li>

                    <li><a href="/csv"><i class="fa fa-smile-o"></i><span>Workflow CSV</span></a>
                        <ul class="sub-menu">
                            <li><?= anchor('csv', 'Selection Fichier') ?></li>
                            <li><?= anchor('csv/geocode', 'Geocodage') ?></li>
                            <li><?= anchor('csv/categorieslink', 'Mappage catégories') ?></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-smile-o"></i><span>CRUD</span></a>
                        <ul class="sub-menu">
                            <li><?= anchor('crud/artisans', 'Artisans') ?></li>
                            <li><?= anchor('crud/categories', 'Categories') ?></li>
                            <li><?= anchor('crud/artisancats', 'ArtisanCats') ?></li>
                            <li><?= anchor('crud/geocoderrors', 'Erreurs de Geocodage') ?></li>
                            <li><?= anchor('crud/jobs', 'Jobs') ?></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!--+
    |<i class="fa fa-file"></i>
    |<i class="fa fa-bar-chart-o"></i>
    |<i class="fa fa-text-height"></i>
    |<i class="fa fa-envelope nav-icon"></i>
    |<i class="fa fa-map-marker nav-icon"></i>
    |<i class="fa fa-table"></i>
    |<i class="fa fa-list-alt"></i>
    |<i class="fa fa-home"></i>
    |<i class="fa fa-smile-o"></i>
    +-->