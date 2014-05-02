<div class="block-flat">
    <div class="header">							
        <h3>Queue</h3>
    </div>
    <div class="content">
        <div class="table-responsive">
            <table class="no-border hover list">
                <tbody id="task-container" class="no-border-y">

                </tbody>
            </table>		
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        fetch();
        window.setInterval(function() {
            update();
        }, 500);
        
        window.setInterval(function() {
            $('#task-container').empty();
            fetch();
        }, 60000);
    });

    function fetch() {
        $.getJSON("worker/getqueue", function(datas) {
            for (var i in datas) {
                if (datas.hasOwnProperty(i)) {
                    $('#task-container').append('<tr class="items"><td><span class="label label-success">' + datas[i].jobs_type
                            + '</span></td><td><p><strong>' + datas[i].jobs_name + '</strong><span>' + datas[i].jobs_description
                            + '</span></p></td><td class="color-success"><div class="progress"><div id="' + datas[i].jobs_id + '" class="progress-bar progress-bar-success" style="width: ' + datas[i].jobs_statut +
                            '%">' + datas[i].jobs_statut + '%</div></div></td></tr>');
                }
            }
        }).done(function() {
            console.log("second success");
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
        $('#task-container').fadeIn(2000);
    }

    function update() {
        $.getJSON("worker/getqueue", function(datas) {
            for (var i in datas) {
                if (datas.hasOwnProperty(i)) {
                    
                    $('#'+datas[i].jobs_id).html(datas[i].jobs_statut+'%');
                    $('#'+datas[i].jobs_id).attr("style", "width:"+datas[i].jobs_statut+"%");
                }
            }
        });
    }
</script>

