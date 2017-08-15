<?php use common\models\User;
use yii\bootstrap\Html;
/**@var $role common\models\Role**/
/**@var $user common\models\User**/
$this->title = 'Главная';
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
?>

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

<!--                -->
<!---->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'Deal'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Вам предложена <g:link-->
<!--                                    url="[resource: event, action: 'thread']">сделка</g:link> с ${event.account == (accounts ?: event.account) ? event.partner.name : event.account.name}-->
<!--                        </g:if>-->
<!--                        <g:if test="${eventType == 'DealNewPost'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые ответы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">сделке</g:link> с ${event.item.account == (accounts ?: event.item.account) ? event.item.partner.name : event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                        <g:if test="${eventType == 'DealNewStatus'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые статусы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">сделке</g:link> с ${event.item.account == (accounts ?: event.item.account) ? event.item.partner.name : event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_MEDIATOR,ROLE_ADMIN">-->
<!--                        <g:if test="${eventType == 'Dispute'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Открыт <g:link url="[resource: event, action: 'thread']">спор</g:link> от ${event.account.name}-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_MEDIATOR,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'DisputeNewPost'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые ответы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">споре</g:link> с ${event.item.account == (accounts ?: event.item.account) ? event.item.partner.name : event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_MEDIATOR,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'DisputeNewStatus'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые статусы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">споре</g:link> с ${event.item.account == (accounts ?: event.item.account) ? event.item.partner.name : event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_JUDGE,ROLE_ADMIN">-->
<!--                        <g:if test="${eventType == 'Claim'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новый <g:link url="[resource: event, action: 'thread']">иск</g:link> от ${event.account.name}-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_MANAGER,ROLE_ADMIN">-->
<!---->
<!--                        <g:if test="${eventType == 'Item'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            <g:link url="[resource: event, action: 'edit']">-->
<!--                                <g:if test="${event.categoryType.code=='GOOD'}">-->
<!--                                    Новый товар-->
<!--                                </g:if>-->
<!--                                <g:else>-->
<!--                                    Новая услуга-->
<!--                                </g:else>-->
<!--                            </g:link> от ${event.account.name}-->
<!---->
<!--                        </g:if>-->
<!--                        <g:if test="${eventType == 'Account'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новое <g:link url="[resource: event, action: 'edit']">предприятие</g:link>-->
<!---->
<!--                        </g:if>-->
<!--                        %{--<g:if test="${eventType == 'NewSuggestion'}">--}%-->
<!--                            %{--Новое <g:link url="[resource: event, action: 'index']">Сообщение</g:link>--}%-->
<!--                            %{--</g:if>--}%-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_JUDGE,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'ClaimNewPost'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые ответы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">иске</g:link> с ${event.item.account == (accounts ?: event.item.account) ? event.item.partner.name : event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_JUDGE,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'ClaimNewStatus'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые статусы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">иске</g:link> с ${event.item.account == (accounts ?: event.item.account) ? event.item.partner.name : event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_MANAGER,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'Review'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новый <g:message code="${'review.value.' + event.value}"/> <g:link url="[resource: event, action: 'show']">отзыв</g:link> от ${event.from.name}-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_JURIST,ROLE_ADMIN">-->
<!--                        <g:if test="${eventType == 'JuristConsult'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новая <g:link url="[resource: event, action: 'thread']">Консультация</g:link> от ${event.account.name}-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_JURIST,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'ConsultNewPost'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые ответы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">консультации</g:link> с ${event.item.jurist == profile ? event.item.account.name : event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_JURIST,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'ConsultNewStatus'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые статусы в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">консультации</g:link> с ${event.item.jurist == profile ? event.item.account.name :event.item.account.name}-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!--                    </sec:ifAnyGranted>-->
<!---->
<!--                    <sec:ifAnyGranted roles="ROLE_MANAGER,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'TicketNewPost'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            Новые Ответы в обращении в <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">Службу поддержки</g:link>-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!---->
<!--                    </sec:ifAnyGranted>-->
<!--                    <sec:ifAnyGranted roles="ROLE_MANAGER,ROLE_ADMIN,ROLE_ACCOUNT">-->
<!--                        <g:if test="${eventType == 'TicketNewStatus'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            <g:link-->
<!--                                    url="[resource: event.item, action: 'thread']">Новые Статусы в обращении </g:link> в Службу поддержки-->
<!--                            <span class="badge">+${event.count}</span>-->
<!--                        </g:if>-->
<!---->
<!--                    </sec:ifAnyGranted>-->
<!--                    <sec:ifAnyGranted roles="ROLE_MANAGER,ROLE_ADMIN">-->
<!--                        <g:if test="${eventType == 'Ticket'}">-->
<!--                            <div class="time"><g:formatDate date="${eventDate}" format="dd MMMM yyyy"/></div>-->
<!--                            <g:link url="[resource: event, action: 'thread']">Новое Обращение</g:link> от ${event.account.name}-->
<!--                        </g:if>-->
<!---->
<!--                    </sec:ifAnyGranted>-->

        </ul>

    </div>
</div>
<?php endif?>

