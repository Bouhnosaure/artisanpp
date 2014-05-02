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
                <div class="cl-mcont aside" >
                    <div class="page-aside codeditor">
                        <div class="">
                            <div class="content">
                                <div class="title">
                                    <h2 class="page-title">Explorateur</h2>
                                    <p class="description">De fichiers ;)</p>
                                </div>
                            </div>
                            <div class="mail-nav collapse">
                                <div id="jao"></div>
                                <br>
                                <button id="send" type="button" class="btn btn-block btn-primary btn-rad" style="width: 98%">Send</button>
                                <br>
                                <div class="fd-tile detail tile-green">
                                    <div id="stat-tile" class="content"></div>
                                    <div class="icon"><i class="fa fa-download"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="code-editor">
                            <div id="console">

                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div id="code1" style="display:none;"></div>
        <?php $this->load->view('elements/stats'); ?><!-- Panneau latéral droit -->
        <?php $this->load->view('elements/footer'); ?><!-- Scripts -->


        <script type="text/javascript">
            $('#jao').jaofiletree({
                script: 'csv/getfilesjson?dir=/',
                onclick: function(elem, type, file, ext) {

                    $.getJSON("csv/openfilejson?file=" + file + "&ext=" + ext, function(data) {
                        $("#code1").empty();
                        $("#console").empty();
                        CodeMirror($('#console')[0], {
                            lineNumbers: true,
                            theme: 'ambiance',
                            value: data.data,
                            mode: "text/x-haskell"
                        });

                    }).done(function() {
                        console.log("second success");
                    }).fail(function() {
                        console.log("error");
                    }).always(function() {
                        console.log("complete");
                    });
                }
                /*oncheck: function(elem, checked, type, file) {
                 }*/
            });

            $("#send").click(function() {
                $.ajax({
                    type: "POST",
                    url: "csv/sendtoqueue",
                    data: {json: JSON.stringify($('#jao').jaofiletree('getchecked'))},
                    cache: false,
                    success: function(data) {
                        $("#stat-tile").html(data).hide().fadeIn(1000);
                        setTimeout(redirect, 3000)//as a debugging message.

                    }
                });// you have missed this bracket
                return false;
            });
            function redirect() {
                $(location).attr('href', "<?= base_url() ?>")
            }

        </script> 
    </div><!-- /page -->
</body>
</html>
