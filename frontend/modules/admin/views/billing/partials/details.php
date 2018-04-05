<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 27.09.17
 * Time: 1:02
 */
?>
<div id="myModalOption" class="modal fade" align="center">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 450px; text-align: left">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title ft">Детализация платежа</h4>
            </div>
            <div id="changeStatusMessage" class="modal-body" >
                <?php if ($data['ErrorCode'] == 0):?>
                <b class="ft" >Номер счета в системе Deloved:</b>
                <span id="siteInvoiceId" class="fr">
                    <?=$data['Payment']['SiteInvoiceID']?>
                </span> <br>
                <hr>
                <b class="ft">Номер счета в платежной системе: </b>
                <span class="fr" id="paymentId">
                    <?=$data['Payment']['PaymentID']?>
                </span> <br>
                <hr>
                <b class="ft">Примечение к платежу:</b><br>
                <span class="fr" id="purpose">
                    <?=$data['Payment']['Purpose']?>
                </span> <br>
                <hr>
                <b class="ft"> Сумма:</b>
                <span class="fr" id="amount">
                    <?=$data['Payment']['Amount']?> <?=$data['Payment']['CurrencyCode']?>
                </span> <br>
                <hr>
                <b class="ft">Способ оплаты: </b>
                <span class="fr" id="paymentMethod">
                     <?=$data['Payment']['PaymentMethod']?>
                </span> <br>

                <hr>
                <b class="ft">Платежная система:</b>
                <span class="fr" id="paymentSystemId">
                     <?=$data['Payment']['PaymentSystemID']?>
                </span> <br>
                <hr>
                <b class="ft">Дата платежа:</b><br>
                <span class="fr" id="lastUpdateTime">
                     <?=$data['Payment']['LastUpdateTime']?>
                </span>
                 <hr>
                <b class="ft">Cтатус платежа:</b><br>
                <span class="fr" id="lastUpdateTime">
                 <?=Yii::t('app',$data['Payment']['State'])?>
                </span>
                <?php endif;?>
                <?php if ($data['ErrorCode'] == -13):?>
                    <div>Платеж отсутствует в системе. Скорее всего вы прервали процесс оплаты.</div>
                <?php endif;?>
            </div>


            <div class="modal-footer">

                <button id="dismissButton" type="button" class="btn btn-default ft" data-dismiss="modal">Отмена</button>

            </div>
        </div>
    </div>
</div>
