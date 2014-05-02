<div class="block-flat">
    <div class="header">							
        <h3>Mise a jour des tables artisans</h3>
    </div>
    <div class="content">
        <table class="no-border">
            <thead class="no-border">
                <tr>
                    <th style="width:80%;">Categories artisans</th>
                    <th class="text-right">Categories normalisées</th>
                </tr>
            </thead>
            <tbody id="table-container" class="no-border-y">
            </tbody>
        </table>	
    </div>
</div>

<div class="block-flat">
    <div class="header">							
        <h3>Mise a jour des tables artisans</h3>
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
<script type="text/javascript">

    function getSelected(sel) {
        $.get("categorieslink", {artid: sel.id, catid: sel.value});
    }

    $(document).ready(function() {

        $.getJSON("categorieslink?artisancats=true", function(jsonresponse) {


            for (var i in jsonresponse[0]) {
                if (jsonresponse[0].hasOwnProperty(i)) {
                    var options = [];
                    for (var val in jsonresponse[1]) {

                        if (jsonresponse[0][i].categories_id == jsonresponse[1][val].categories_id) {

                            options[val] = "<option value=" + jsonresponse[1][val].categories_id + " selected>" + jsonresponse[1][val].categories_libelle + "</option>";
                        }
                        else {
                            options[val] = "<option value=" + jsonresponse[1][val].categories_id + ">" + jsonresponse[1][val].categories_libelle + "</option>";
                        }
                    }
                    $('#table-container').append(
                            '<tr>\n\
                                <td><strong>' + jsonresponse[0][i].artisancats_libelle + '</strong></td>\n\
                                <td class="text-right"><select class="form-control" onchange="getSelected(this);" id="' + jsonresponse[0][i].artisancats_id + '">' + options + '</select></td>\n\
                            </tr>');
                }
            }
        }).done(function() {
            console.log("second success");
        });
        $('.md-trigger').modalEffects();
        $("#launch").click(function() {
            $.ajax({
                type: "GET",
                url: "sendtoqueue?mapping=true",
                cache: false,
                success: function(data) {
                    if (data == "ok") {
                        setTimeout(redirect, 3000)//as a debugging message.
                    }
                }
            }); // you have missed this bracket
            return false;
        });
        function redirect() {
            $(location).attr('href', "<?= base_url() ?>")
        }

    });
</script>
