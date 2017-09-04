<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$session = Yii::$app->session;
if ($session->has('lang')){
    $lang = $session->get('lang');
}else{
    $lang = Yii::$app->language;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language = $lang ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
</head>
<body>
<?php $this->beginBody() ?>
<!-- Yandex.Metrika counter -->
<!--<script type="text/javascript">-->
<!--    (function (d, w, c) {-->
<!--        (w[c] = w[c] || []).push(function() {-->
<!--            try {-->
<!--                w.yaCounter42521619 = new Ya.Metrika({-->
<!--                    id:42521619,-->
<!--                    clickmap:true,-->
<!--                    trackLinks:true,-->
<!--                    accurateTrackBounce:true,-->
<!--                    webvisor:true-->
<!--                });-->
<!--            } catch(e) { }-->
<!--        });-->
<!---->
<!--        var n = d.getElementsByTagName("script")[0],-->
<!--            s = d.createElement("script"),-->
<!--            f = function () { n.parentNode.insertBefore(s, n); };-->
<!--        s.type = "text/javascript";-->
<!--        s.async = true;-->
<!--        s.src = "https://mc.yandex.ru/metrika/watch.js";-->
<!---->
<!--        if (w.opera == "[object Opera]") {-->
<!--            d.addEventListener("DOMContentLoaded", f, false);-->
<!--        } else { f(); }-->
<!--    })(document, window, "yandex_metrika_callbacks");-->
<!--</script>-->
<!--<noscript><div><img src="https://mc.yandex.ru/watch/42521619" style="position:absolute; left:-9999px;" alt="" /></div></noscript>-->
<!--<!-- /Yandex.Metrika counter -->
<?=$this->render("//common/front/header")?>

<?=$this->render("//common/flash-message")?>


<div class="container" style="width: 100%"><?= $content ?></div>



<?=$this->render("//common/front/footer") ?>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
