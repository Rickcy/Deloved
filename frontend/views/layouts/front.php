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

<?=$this->render("//common/front/header")?>

<?=$this->render("//common/flash-message")?>


<div class="container"><?= $content ?></div>



<?=$this->render("//common/front/footer") ?>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
