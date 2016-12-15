<?php
$i=0;
?>

<?if (Yii::$app->session->getAllFlashes()):?>
<?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
        <?if (is_array($messages)):?>
        <? foreach ($messages as $message):?>
        <div style="top:<?=$i+=10?>%" class="flash-message flash-alert alert alert-<?=$type ?>" role="alert">
            <?= $message ?>
        </div>
        <?endforeach;?>
        <?endif;?>


<?php endforeach ?>
<?endif?>
<div id="flash-message" class="flash-alert alert alert-info" hidden></div>
<script>

    var ib = $('.flash-message');

    function showMessages(){
        setTimeout(function(){

            ib.fadeIn(450);
            setTimeout(function(){
                ib.fadeOut(3000, function() {
                    //ib.remove();
                });
                ib.mouseenter(function() {
                    ib.clearQueue();
                    ib.stop();
                    ib.animate({opacity: 1});
                });
                ib.mouseleave(function() {
                    ib.fadeOut(6000, function() {
                        //ib.remove();
                    });
                });
            }, 4000)

        }, 100)
    }

    showMessages();
</script>
