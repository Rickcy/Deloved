<?php

$this->title = Yii::t('app', 'Forms of documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">
    <?php if (\common\models\User::checkRole(['ROLE_USER'])):?>
    <a href="/admin/document/contract-for-services" class="btn btn-success" >Подготовить договор на оказание услуг</a>
    <br>
    <br>
    <a href="/admin/document/delivery-contract" class="btn btn-success"  >Подготовить договор поставки</a>
    <?php endif;?>
</div>
