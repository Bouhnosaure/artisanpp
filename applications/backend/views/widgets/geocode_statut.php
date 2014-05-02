<div class="row">

    <div class="col-sm-6 col-md-6">

        <div class="block-flat">
            <div class="header">							
                <h3>Geocodage</h3>
            </div>
            <div class="content">
                <h4>Attention</h4>
                <p>Cette action envoie envoie une commande au MinionManager, une fois lancée elle ne peut être arrétée.</p>
                <div class="spacer2 text-center">
                    <button class="btn btn-danger btn-flat md-trigger" data-modal="full-danger">Lancer</button>
                </div>
                <div class="md-modal full-color danger md-effect-8" id="full-danger">
                    <div class="md-content">
                        <div class="modal-header">
                            <h3>X_X</h3>
                            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <h4><strong>Attention</strong></h4>
                                <h5>Vous êtes sur le point d'envoyer une tache au MinionManager</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-mono3 btn-flat md-close" data-dismiss="modal">Annuler</button>
                            <button id="launch" type="button" class="btn btn-danger btn-mono3 btn-flat md-close" data-dismiss="modal">Lancer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="block-flat">
            <div class="header">
                <h3>Statut Géocodage</h3>
            </div>
            <div class="content">
                <div id="piec" style="height: 300px; padding: 0px; position: relative;">
                </div>
            </div>
        </div>
    </div>
    <div class="block-flat">
        <div class="header">
            <h3>Détail Géocodage</h3>
        </div>
        <div id="legendcontainer" class="content">
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $.getJSON("geocodestats", function(data) {
            $.plot('#piec', data, {
                series: {
                    pie: {
                        show: true,
                        innerRadius: 0.27,
                        shadow: {
                            top: 5,
                            left: 15,
                            alpha: 0.3
                        },
                        stroke: {
                            width: 0
                        },
                        label: {
                            show: true,
                            formatter: function(label, series) {
                                return '<div style="font-size:12px;text-align:center;padding:2px;color:#333;">' + label + '</div>';
                            }
                        },
                        highlight: {
                            opacity: 0.08
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                colors: ["#5793f3", "#dd4d79", "#bd3b47", "#dd4444", "#fd9c35", "#fec42c", "#d4df5a", "#5578c2"],
                legend: {
                    show: true,
                    container: $("#legendcontainer")
                }
            });
        });

        $('.md-trigger').modalEffects();

        $("#launch").click(function() {
            $.ajax({
                type: "GET",
                url: "sendtoqueue?geocode=true",
                cache: false,
                success: function(data) {
                    if (data == "ok") {
                        setTimeout(redirect, 3000)//as a debugging message.
                    }
                }
            });// you have missed this bracket
            return false;
        });
        
        function redirect() {
            $(location).attr('href', "<?= base_url() ?>")
        }

    });
</script>

