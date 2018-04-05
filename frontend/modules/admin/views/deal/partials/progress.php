<?php

use common\models\Deal;

?>



    <div class="deloved-progress-bar">

        <input id="dealProgressVal" type="hidden" value="<?=Deal::getPosition($status)?>">
        <?php if(Deal::REJECTED == $status || Deal::FAILED == $status):?>
            <div class="deloved-progress failure-progress" style="width: <?=Deal::getPosition($status)?>%"></div>
        <?php elseif (Deal::SUSPENDED == $status):?>
            <div class="deloved-progress suspended-progress" style="width:<?=Deal::getPosition($status)?>%"></div>
        <?php else:;?>
            <div class="deloved-progress success-progress" style="width: <?=Deal::getPosition($status)?>%"></div>
        <?php endif;?>


        <?php if (Deal::SUSPENDED != $status || Deal::FAILED != $status || Deal::CONFIRMED != $status || Deal::REJECTED != $status ):?>
            <div class="deloved-progress-check" style="left: 28%" data-toggle="tooltip" data-placement="top" title="Договор подписан"></div>
        <?php endif;?>

        <?php if (Deal::WAIT_NON_PAIDED_EXECUTE == $status || Deal::NON_PAIDED_EXECUTE == $status || Deal::FULL_POST_PAID == $status):?>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::WAIT_NON_PAIDED_EXECUTE)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
			 background: -ms-linear-gradient(right,#ffa200, #e9ec10);
			 background: -o-linear-gradient(right,#ffa200,#e9ec10);
			 background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::WAIT_NON_PAIDED_EXECUTE)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::NON_PAIDED_EXECUTE)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::NON_PAIDED_EXECUTE)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::FULL_POST_PAID)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::FULL_POST_PAID)?>"
            ></div>
            <div class="deloved-progress-check" style="left: 46%" data-toggle="tooltip" data-placement="top" title="Исполнения обязательств"></div>
            <div class="deloved-progress-check" style="left: 64%" data-toggle="tooltip" data-placement="top" title="Обязательства исполнены"></div>
            <div class="deloved-progress-check" style="left: 82%" data-toggle="tooltip" data-placement="top" title="Оплата внесена"></div>
        <?php endif;?>


        <?php if (Deal::FULL_PRE_PAID == $status || Deal::FULL_PRE_PAID_CONFIRM == $status || Deal::WAIT_PAIDED_EXECUTE == $status || Deal::PAIDED_EXECUTE == $status):?>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::FULL_PRE_PAID)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::FULL_PRE_PAID)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::FULL_PRE_PAID_CONFIRM)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::FULL_PRE_PAID_CONFIRM)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::WAIT_PAIDED_EXECUTE)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::WAIT_PAIDED_EXECUTE)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::PAIDED_EXECUTE)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::PAIDED_EXECUTE)?>"
            ></div>

            <div class="deloved-progress-check" style="left: 46%" data-toggle="tooltip" data-placement="top" title="Предоплата внесена"></div>
            <div class="deloved-progress-check" style="left: 64%" data-toggle="tooltip" data-placement="top" title="Полная предоплата подтвержденна"></div>
            <div class="deloved-progress-check" style="left: 82%" data-toggle="tooltip" data-placement="top" title="Исполнения обязательств"></div>
            <div class="deloved-progress-check" style="left: 95%" data-toggle="tooltip" data-placement="top" title="Обязательства исполнены"></div>
        <?php endif;?>


        <?php if (Deal::HALF_PRE_PAID == $status || Deal::HALF_PRE_PAID_CONFIRM == $status || Deal::WAIT_HALF_PAIDED_EXECUTE == $status || Deal::HALF_PAIDED_EXECUTE == $status || Deal::HALF_POST_PAIDED == $status):?>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::HALF_PRE_PAID)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::HALF_PRE_PAID)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::HALF_PRE_PAID_CONFIRM)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::HALF_PRE_PAID_CONFIRM)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::WAIT_HALF_PAIDED_EXECUTE)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::WAIT_HALF_PAIDED_EXECUTE)?>"
            ></div>
            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::HALF_PAIDED_EXECUTE)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::HALF_PAIDED_EXECUTE)?>"
            ></div>

            <div class="deloved-progress-check"
                 style="left: <?= Deal::getPosition(Deal::HALF_POST_PAIDED)?>%;background: -moz-linear-gradient(right, #ffa200, #e9ec10);
                         background: -ms-linear-gradient(right,#ffa200, #e9ec10);
                         background: -o-linear-gradient(right,#ffa200,#e9ec10);
                         background: -webkit-linear-gradient(right,#ffa200, #e9ec10);"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="<?= Deal::getNameStatus(Deal::HALF_POST_PAIDED)?>"
            ></div>

            <div class="deloved-progress-check" style="left: 40%" data-toggle="tooltip" data-placement="top" title="Частичная предоплата"></div>
            <div class="deloved-progress-check" style="left: 52%" data-toggle="tooltip" data-placement="top" title="Частичная предоплата подтвержденна"></div>
            <div class="deloved-progress-check" style="left: 64%" data-toggle="tooltip" data-placement="top" title="Исполнения обязательств"></div>
            <div class="deloved-progress-check" style="left: 76%" data-toggle="tooltip" data-placement="top" title="Обязательства исполнены"></div>
            <div class="deloved-progress-check" style="left: 88%" data-toggle="tooltip" data-placement="top" title="Полная предоплата внесена"></div>
        <?php endif;?>

    </div>

