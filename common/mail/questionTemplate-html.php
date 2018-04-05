<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 08.02.18
 * Time: 17:19
 */
$template = \common\models\Questions::find()->limit(1)->all()[0]->reason;
?>
<div class="template">
    <?=$template?>
</div>