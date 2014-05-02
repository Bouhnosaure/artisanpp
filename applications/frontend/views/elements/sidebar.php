<div data-role="panel" data-position="left" data-position-fixed="false" data-display="overlay" id="nav-panel" data-theme="a">
    <a href="#" class="logo">logo</a>
    <ul id="cat-container" data-role="listview" data-theme="a" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
        
    </ul>
    <div class="copyright">
        <ul class="corporate">
            <li><a href="pages/contact">Contact</a></li>
            <li><a href="pages/about">Blog</a></li>
            <li><a href="pages/about">About</a></li>
            <li><a href="pages/faq">F.A.Q</a></li>
        </ul>
        <p>Artisanapp © 2013</p>
    </div>
</div><!-- /panel -->
<script type="text/javascript">
    $(document).ready(function() {
        fetch();
    });
    function fetch() {
        $.getJSON("home/getcategories", function(datas) {
            for (var i in datas) {
                if (datas.hasOwnProperty(i)) {
                    $('#cat-container').append(
                            '<li data-filtertext="wai-aria voiceover accessibility screen reader" data-icon="check">\n\
                        <a href="categories/' + datas[i].categories_id + '" class="list-group-item ui-btn ui-btn-icon-right ui-icon-check">' + datas[i].categories_libelle + '</a>\n\
                     </li>');
                }
            }
        }).done(function() {
            console.log("second success");
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }
</script>