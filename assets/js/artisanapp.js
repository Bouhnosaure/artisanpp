$(document).on("pagecreate", "#map-page", function() {

    var $mapSwitch = $("#map-switch");
    var $listSwitch = $("#list-switch");
    var $map = $("#map_canvas");
    var $list = $("#list-canvas");
    $list.hide();

    $mapSwitch.on("click", function(e) {
        $map.show();
        $list.hide();
    });
    $listSwitch.on("click", function(e) {
        $list.show();
        $map.hide();
    });

});

