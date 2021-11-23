<!doctype HTML>

<?PHP

?>

<html>
    <head>
        <meta charset="utf-8"/>
        <!--meta name="viewport" content="width=device-width,initial-scale=1" /-->
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/main_01.css"/>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    
    <body>
        <div class="dscp_bgp">
            <!--div class="ifrswipt">
                <ul id="ifrswipt">
                    <li><img class="imgswipt" src="images/6G_Dscp_001.jpg" width="100%" height="100%" alt=""/></li>
                    
                    <li><img class="imgswipt" src="images/6G_Dscp_002.jpg" width="100%" height="100%" alt=""/></li>
                </ul>
            </di-->
                <img width="100%" height="100%" src="images/6G_Dscp_001.jpg" alt=""/>
        </div>
    </body>
</html>

<script type="text/javascript">
var swiptimg = {
    $index: 0,
    $width: 352,
    $swipt: 0,
    $legth: 6
}
var $imgul = $("#ifrswipt");
$(".imgswipt").each(function() {
    $(this).swipeleft(function() {
        if (swiptimg.$index < swiptimg.$legth) {
            swiptimg.$index++;
            swiptimg.$swipt = -swiptimg.$index * swiptimg.$width;
            $imgul.animate({ left: swiptimg.$swipt }, "slow");
        }
    }).swiperight(function() {
        if (swiptimg.$index > 0) {
            swiptimg.$index--;
            swiptimg.$swipt = -swiptimg.$index * swiptimg.$width;
            $imgul.animate({ left: swiptimg.$swipt }, "slow");
        }
    })
})
</script>
