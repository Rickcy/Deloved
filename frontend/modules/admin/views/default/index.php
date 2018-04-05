<?php use common\models\Account;
use common\models\User;
use yii\bootstrap\Html;
use yii\db\Expression;

/**@var $role common\models\Role**/
/**@var $user common\models\User**/
/**@var $account common\models\Account**/
$this->title = 'Главная';
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
?>

<?php if (User::checkRole(['ROLE_USER'])):?>
    <div style="margin-bottom: 2rem;margin-top: 2rem" class="text-center">
        <a href="/admin/information"  style="font-size: 8pt;margin-left: 0;border-radius: 20px;padding:15px 11px 15px 35px;width: 100%;min-width: 194px;color: white;font-weight: bold;background: #94c43d url(/images/front/dea.png) no-repeat center left 10px;
    background-size: 20px;box-shadow: 0 0 5px #c5c5c5;" >Совершить безопасную сделку</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title ft">Рейтинг и мои данные</h3>
                </div>

                <div class="panel-body">
                   <?php if ($user->freeUser()):?>
                        Доступно для платной подписки
                    <?php else:?>
                       <h4 class="ft">Рейтинг </h4>
                       <span class=rating><?=Account::getRating($account)?></span>

                       <ul style="margin-left: 20px;margin-top: 10px">
                           <li>Положительных отзывов <?=\common\models\Review::find()->where(['about_id'=>$account->id])->andWhere(['published'=>true])->andWhere(['value'=>1])->count()?></li>
                           <li>Отрицательных отзывов <?=\common\models\Review::find()->where(['about_id'=>$account->id])->andWhere(['published'=>true])->andWhere(['value'=>-1])->count()?></li>
                           <li>Товаров в базе <?=\common\models\Goods::find()->where(['account_id'=>$account->id])->count()?></li>
                           <li>Услуг в базе <?=\common\models\Services::find()->where(['account_id'=>$account->id])->count()?></li>
                           <li>Совершенных сделок  <?=(\common\models\Deal::find()->where(['buyer_id'=>$account->profile_id])->andWhere(['status'=>500])->count()) + (\common\models\Deal::find()->where(['seller_id'=>$account->profile_id])->andWhere(['status'=>500])->count())?></li>
                           <li>Активных сделок <?=(\common\models\Deal::find()->where(['buyer_id'=>$account->profile_id])->andWhere(['in','status',[100,101,102,103,104,200,201,202,300,301,302,304,400,401,402,403,404,504]])->count()) + (\common\models\Deal::find()->where(['seller_id'=>$account->profile_id])->andWhere(['in','status',[100,101,102,103,104,200,201,202,300,301,302,304,400,401,402,403,404,504]])->count())?></li>
                           <li>Открытых споров <?=(\common\models\Dispute::find()->where(['profile_id'=>$account->profile_id])->andWhere(['status'=>10])->count()) + (\common\models\Dispute::find()->where(['partner_id'=>$account->profile_id])->andWhere(['status'=>10])->count())?></li>
                           <li>Проигранных споров <?=\common\models\Dispute::find()->where(['partner_id'=>$account->profile_id])->andWhere(['status'=>20])->count()?></li>
                           <li>Открытых исков <?=(\common\models\Claim::find()->where(['profile_id'=>$account->profile_id])->andWhere(['status'=>10])->count()) + (\common\models\Claim::find()->where(['partner_id'=>$account->profile_id])->andWhere(['status'=>10])->count())?></li>
                           <li>Проигранных исков <?=\common\models\Claim::find()->where(['partner_id'=>$account->profile_id])->andWhere(['status'=>20])->count()?></li>
                       </ul>
                    <?php endif;?>



                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title ft">Посещаемость</h3>
                </div>

                <div class="panel-body">
                    <?php if ($user->freeUser()):?>
                        Доступно для платной подписки
                    <?php else:?>


                        <h3 class="ft">В текущем месяце</h3>
                        <?php if ($account->verify_status == 1):?>
                        <ul style="margin-left: 20px">
                            <li>Просмотры карточки <?=(\common\models\CountView::findOne(['account_id'=>$account->id]))->count_for_month?></li>
                            <li>Просмотры товаров <?=(\common\models\CountView::findOne(['account_id'=>$account->id]))->count_goods_for_month?></li>
                            <li>Просмотры услуг <?=(\common\models\CountView::findOne(['account_id'=>$account->id]))->count_services_for_month?></li>
                        </ul>

                        <h3 class="ft">За все время</h3>
                        <ul style="margin-left: 20px">
                            <li>Просмотры карточки <?=(\common\models\CountView::findOne(['account_id'=>$account->id]))->count_for_all?></li>
                            <li>Просмотры товаров <?=(\common\models\CountView::findOne(['account_id'=>$account->id]))->count_goods_for_all?></li>
                            <li>Просмотры услуг <?=(\common\models\CountView::findOne(['account_id'=>$account->id]))->count_services_for_all?></li>
                        </ul>
                    <?php else:;?>
                            <ul style="margin-left: 20px">
                                <li>Просмотры карточки 0 </li>
                                <li>Просмотры товаров 0</li>
                                <li>Просмотры услуг 0</li>
                            </ul>

                            <h3 class="ft">За все время</h3>
                            <ul style="margin-left: 20px">
                                <li>Просмотры карточки 0</li>
                                <li>Просмотры товаров  0</li>
                                <li>Просмотры услуг  0</li>
                            </ul>
                    <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>


<?php if(count($lenta) > 0):?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Деловые события</h3>
    </div>

    <div class="panel-body">

        <div class="lead">Внимание! В ленте появляются только новые события!</div>

        <ul class="list-group">

             

                    <?php if(isset($lenta['accounts'])):?>
                        <?php foreach ($lenta['accounts'] as $account):?>
                 <li class="list-group-item">
                         <div class="time"><?=(new DateTime($account['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                         Новое <a href="/admin/account/update?id=<?=$account['new_account_id']?>">предприятие</a>
                </li>
                            <?php endforeach;?>
                        <?php endif;?>


            <?php if(User::checkRole(['ROLE_USER']) &&  (User::findOne(Yii::$app->user->id))->profile->isManager()):?>
                <?php if(isset($lenta['tasks'])):?>
                    <?php foreach ($lenta['tasks'] as $task):?>
                        <li class="list-group-item">
                            <div class="time"><?=(new DateTime($task['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                           У вас новая <a href="/admin/crm/task?id=<?$task['task_id']?>">задача</a>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
            <?php endif;?>



                    <?php if(isset($lenta['goods'])):?>
                        <?php foreach ($lenta['goods'] as $good):?>
                        <li class="list-group-item">
                        <div class="time"><?=(new DateTime($good['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                            Новый <a href="/admin/goods/update?id=<?=$good['new_good_id']?>">товар</a>
                        </li>
                        <?php endforeach;?>
                    <?php endif;?>

                    <?php if(isset($lenta['services'])):?>
                        <?php foreach ($lenta['services'] as $service):?>
                            <li class="list-group-item">
                                <div class="time"><?=(new DateTime($service['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                Новая  <a href="/admin/services/update?id=<?=$service['new_service_id']?>">услуга</a>
                            </li>
                        <?php endforeach;?>
                    <?php endif;?>

                    <?php if(isset($lenta['suggestions'])):?>
                        <?php foreach ($lenta['suggestions'] as $suggestion):?>
                            <li class="list-group-item">
                                <div class="time"><?=(new DateTime($suggestion['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                Новое <a href="/admin/suggestion/show">обращение</a>
                            </li>
                        <?php endforeach;?>
                    <?php endif;?>

                     <?php if(isset($lenta['tickets'])):?>
                         <?php foreach ($lenta['tickets'] as $ticket):?>
                             <li class="list-group-item">
                                 <div class="time"><?=(new DateTime($ticket['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                 Новое <a href="/admin/ticket/show?id=<?=$ticket['new_ticket_id']?>">обращение в Службу поддержки</a>
                             </li>
                         <?php endforeach;?>
                     <?php endif;?>

                     <?php if(isset($lenta['tickets_posts'])):?>
                         <?php foreach ($lenta['tickets_posts'] as $tickets_posts):?>
                             <li class="list-group-item">
                                 <div class="time"><?=(new DateTime($tickets_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                 Новое <a href="/admin/ticket/show?id=<?=$tickets_posts['ticket_id']?>">сообщение в обращении в Службу поддержки</a>
                             </li>
                         <?php endforeach;?>
                     <?php endif;?>
                     <?php if(isset($lenta['consults'])):?>
                         <?php foreach ($lenta['consults'] as $consults):?>
                             <li class="list-group-item">
                                 <div class="time"><?=(new DateTime($consults['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                 Новое <a href="/admin/consult/show?id=<?=$consults['new_consult_id']?>">обращение за помощью Юристу</a>
                             </li>
                         <?php endforeach;?>
                     <?php endif;?>

                     <?php if(isset($lenta['consults_posts'])):?>
                         <?php foreach ($lenta['consults_posts'] as $consults_posts):?>
                             <li class="list-group-item">
                                 <div class="time"><?=(new DateTime($consults_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                 Новое <a href="/admin/consult/show?id=<?=$consults_posts['consult_id']?>">сообщение в обращение за помощью Юристу</a>
                             </li>
                         <?php endforeach;?>
                     <?php endif;?>

                    <?php if (User::checkRole(['ROLE_USER'])):?>
                      <?php if(isset($lenta['deals'])):?>
                          <?php foreach ($lenta['deals'] as $deals):?>
                              <li class="list-group-item">
                                  <div class="time"><?=(new DateTime($deals['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                Вам предложена  новая <a href="/admin/deal/show?id=<?=$deals['new_deal_id']?>">сделка</a>
                              </li>
                          <?php endforeach;?>
                      <?php endif;?>
                        <?php if(isset($lenta['disputes'])):?>
                            <?php foreach ($lenta['disputes'] as $disputes):?>
                                <li class="list-group-item">
                                    <div class="time"><?=(new DateTime($disputes['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                    У вас новый <a href="/admin/dispute/show?id=<?=$disputes['new_dispute_id']?>">спор</a>
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>
                        <?php if(isset($lenta['claims'])):?>
                            <?php foreach ($lenta['claims'] as $claims):?>
                                <li class="list-group-item">
                                    <div class="time"><?=(new DateTime($claims['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                    У вас новый <a href="/admin/claim/show?id=<?=$claims['new_claim_id']?>">иск</a>
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>

                        <?php if(isset($lenta['reviews'])):?>
                            <?php foreach ($lenta['reviews'] as $reviews):?>
                                <?php
                                $review = \common\models\Review::findOne($reviews['new_review_id']);
                                if ($review->published == true):?>
                                <li class="list-group-item">
                                    <div class="time"><?=(new DateTime($reviews['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                    У вас новый <a href="/admin/review/show?id=<?=$reviews['new_review_id']?>">отзыв</a>
                                </li>
                                <?php else:?>
                                    <li class="list-group-item">
                                        <div class="time"><?=(new DateTime($reviews['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                        У вас замечания по <a href="/admin/review/edit?id=<?=$reviews['new_review_id']?>">отзыву</a>
                                    </li>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>

                      <?php if(isset($lenta['deals_posts'])):?>
                          <?php foreach ($lenta['deals_posts'] as $deals_posts):?>
                              <li class="list-group-item">
                                  <div class="time"><?=(new DateTime($deals_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                 У вас в сделке  новое <a href="/admin/deal/show?id=<?=$deals_posts['deal_id']?>">сообщение</a>
                              </li>
                          <?php endforeach;?>
                      <?php endif;?>

                        <?php if(isset($lenta['disputes_posts'])):?>
                            <?php foreach ($lenta['disputes_posts'] as $disputes_posts):?>
                                <li class="list-group-item">
                                    <div class="time"><?=(new DateTime($disputes_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                    У вас в споре новое <a href="/admin/dispute/show?id=<?=$disputes_posts['dispute_id']?>">сообщение</a>
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>

                        <?php if(isset($lenta['claims_posts'])):?>
                            <?php foreach ($lenta['claims_posts'] as $claims_posts):?>
                                <li class="list-group-item">
                                    <div class="time"><?=(new DateTime($claims_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                    У вас в иске новое <a href="/admin/claim/show?id=<?=$claims_posts['claim_id']?>">сообщение</a>
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>

                     <?php endif;?>

            <?php if (User::checkRole(['ROLE_MEDIATOR'])):?>
            <?php if(isset($lenta['disputes'])):?>
                <?php foreach ($lenta['disputes'] as $disputes):?>
                    <li class="list-group-item">
                        <div class="time"><?=(new DateTime($disputes['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                        В системе  новый <a href="/admin/dispute/show?id=<?=$disputes['new_dispute_id']?>">спор</a>
                    </li>
                <?php endforeach;?>
            <?php endif;?>
                <?php if(isset($lenta['disputes_posts'])):?>
                    <?php foreach ($lenta['disputes_posts'] as $disputes_posts):?>
                        <li class="list-group-item">
                            <div class="time"><?=(new DateTime($disputes_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                            Новое <a href="/admin/dispute/show?id=<?=$disputes_posts['dispute_id']?>">сообщение в споре</a>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
            <?php endif;?>
            <?php if (User::checkRole(['ROLE_JUDGE'])):?>
            <?php if(isset($lenta['claims'])):?>
                <?php foreach ($lenta['claims'] as $claims):?>
                    <li class="list-group-item">
                        <div class="time"><?=(new DateTime($claims['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                        В системе  новый <a href="/admin/claim/show?id=<?=$claims['new_claim_id']?>">иск</a>
                    </li>
                <?php endforeach;?>
            <?php endif;?>
                <?php if(isset($lenta['claims_posts'])):?>
                    <?php foreach ($lenta['claims_posts'] as $claims_posts):?>
                        <li class="list-group-item">
                            <div class="time"><?=(new DateTime($claims_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                            Новое <a href="/admin/claim/show?id=<?=$claims_posts['claim_id']?>">сообщение в иске</a>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
            <?php endif;?>


                     <?php if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                         <?php if(isset($lenta['deals'])):?>
                             <?php foreach ($lenta['deals'] as $deals):?>
                                 <li class="list-group-item">
                                     <div class="time"><?=(new DateTime($deals['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                     В системе  новая <a href="/admin/deal/show?id=<?=$deals['new_deal_id']?>">сделка</a>
                                 </li>
                             <?php endforeach;?>
                         <?php endif;?>
                         <?php if(isset($lenta['disputes'])):?>
                             <?php foreach ($lenta['disputes'] as $disputes):?>
                                 <li class="list-group-item">
                                     <div class="time"><?=(new DateTime($disputes['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                     В системе  новый <a href="/admin/dispute/show?id=<?=$disputes['new_dispute_id']?>">спор</a>
                                 </li>
                             <?php endforeach;?>
                         <?php endif;?>
                         <?php if(isset($lenta['claims'])):?>
                             <?php foreach ($lenta['claims'] as $claims):?>
                                 <li class="list-group-item">
                                     <div class="time"><?=(new DateTime($claims['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                     В системе  новый <a href="/admin/claim/show?id=<?=$claims['new_claim_id']?>">иск</a>
                                 </li>
                             <?php endforeach;?>
                         <?php endif;?>
                         <?php if(isset($lenta['reviews'])):?>
                             <?php foreach ($lenta['reviews'] as $reviews):?>
                                 <li class="list-group-item">
                                     <div class="time"><?=(new DateTime($reviews['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                     В системе  новый <a href="/admin/review/edit?id=<?=$reviews['new_review_id']?>">отзыв</a>
                                 </li>
                             <?php endforeach;?>
                         <?php endif;?>

                         <?php if(isset($lenta['deals_posts'])):?>
                             <?php foreach ($lenta['deals_posts'] as $deals_posts):?>
                                 <li class="list-group-item">
                                     <div class="time"><?=(new DateTime($deals_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                     Новое <a href="/admin/deal/show?id=<?=$deals_posts['deal_id']?>">сообщение в сделке</a>
                                 </li>
                             <?php endforeach;?>
                         <?php endif;?>
                         <?php if(isset($lenta['claims_posts'])):?>
                             <?php foreach ($lenta['claims_posts'] as $claims_posts):?>
                                 <li class="list-group-item">
                                     <div class="time"><?=(new DateTime($claims_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                    Новое <a href="/admin/claim/show?id=<?=$claims_posts['claim_id']?>">сообщение в иске</a>
                                 </li>
                             <?php endforeach;?>
                         <?php endif;?>
                         <?php if(isset($lenta['disputes_posts'])):?>
                             <?php foreach ($lenta['disputes_posts'] as $disputes_posts):?>
                                 <li class="list-group-item">
                                     <div class="time"><?=(new DateTime($disputes_posts['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></div>
                                     Новое <a href="/admin/dispute/show?id=<?=$disputes_posts['dispute_id']?>">сообщение в споре</a>
                                 </li>
                             <?php endforeach;?>
                         <?php endif;?>


                     <?php endif;?>


        </ul>

    </div>
</div>
<?php endif?>

