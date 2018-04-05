<?php

?>
<?php if($type == 1):?>
    <?php $this->title ='Предложение сделки'?>
    <div class="goods-create">
        <h3 class="text-left">Предложение сделки</h3>

        <div class="goods-create">
            <div id="w0" class="form-horizontal"  method="post">
                <h3>Сделка предлагается предприятию : <a href="">ООО "АЛДА"</a></h3>
                <hr>

                <div class="form-group field-deal-isbuyer">
                    <div class="col-sm-3 control-label"><label class="control-label">Выбирете ваш статус</label></div><div class="col-sm-5"><input name="Deal[isBuyer]" value="" type="hidden"><div id="deal-isbuyer" class="btn-group" value="1" data-toggle="buttons"><label class="btn btn-default active"><input name="Deal[isBuyer]" value="1" checked="" type="radio">Я хочу купить</label>
                            <label class="btn btn-default"><input name="Deal[isBuyer]" value="0" type="radio">Я хочу продать</label></div></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                </div>
                <hr>
                <div class="form-group field-deal-detailtext">
                    <div class="col-sm-3 control-label"><label class="control-label" for="deal-detailtext">Содержание</label></div><div class="col-sm-5"><textarea id="deal-detailtext" class="form-control" name="Deal[detailText]" rows="6"></textarea></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                </div>                <div class="form-group text-left">
                    <button type="submit" class="btn create-btn btn-md btn-success">Предложение сделки</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/index">Отмена</a>        </div>

            </div>
        </div>

    </div>
<?php elseif ($type == 2):?>
    <?php $this->title ='Подать иск'?>
    <div id="create-claim" role="main">
        <div class="lead">Иск к предприятию:  <a href="">ООО "АЛДА"</a></div>


        <div class="col-sm-12" style="padding:10px">
            <ul style="list-style:none;padding-left: 0">
                <li style="padding: 5px;font-size: 12pt"><img style="width: 6%;margin-left: 16px;margin-right: 14px" src="/images/admin/sud_ultra.png">При подаче иска вы всегда можете воспользоваться
                    <a  href="">помощью юриста</a> </li>
                <li style="padding: 5px;font-size: 12pt"><img style="width: 5%;margin-left: 20px;margin-right: 18px" src="/images/admin/hammer.png">Иск будет рассмотрен в <a target="_blank" href="http://delovedsud.ru">Третейском суде "Деловед"</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="info" style="padding:10px;">Опишите в текстовом поле кратко суть иска.</div>
        <div class="claim-create">
            <div id="w0" class="form-horizontal"  >
                <input name="_csrf-frontend" value="Ym5BU0tFYXgVKWw9HRAFFyc5MGt/EAcsDz4NYngGNxwrIgdjJTIiQA==" type="hidden">
                <div class="form-group field-claim-detailtext required">
                    <div class="col-sm-2 control-label"><label class="control-label" for="claim-detailtext">Детальное описание</label></div><div class="col-sm-6"><textarea id="claim-detailtext" class="form-control" name="Claim[detailText]" maxlength="255" rows="5"></textarea></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                </div>        <hr>

                <div class="col-sm-12" style="padding: 15px;font-size: 12pt">
                    <h4>Прикрепите копии следующих документов</h4>
                    <table class="table table-responsive table-bordered">
                        <tbody>
                        <tr>
                            <td>Исковое заявление</td>
                            <td class="text-center">
                                <button type="button" class="noFileClaim btn create-btn btn-xs btn-success">Прикрепить файл</button>                            <div class="form-group field-claim-file">
                                    <div class="col-sm-2 control-label"><label class="control-label" for="claim-file"></label></div><div class="col-sm-6"><input name="Claim[claimFile]" value="" type="hidden"><input id="claim-file" class="hidden" name="Claim[claimFile]" type="file"></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                                </div>                        </td>
                            <td class="text-center" id="claim-result" style="vertical-align: middle">
                                <span class="glyphicon glyphicon-remove" style="font-size: 1.4em;color: red;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Документ об оплате третейского сбора(<a target="_blank" href="http://delovedsud.ru/treteiski-sbor/calculator.php">Расчет третейского сбора</a>)</td>
                            <td class="text-center">
                                <button type="button" class="noFileSud btn create-btn btn-xs btn-success">Прикрепить файл</button>                            <div class="form-group field-claim-sud-file">
                                    <div class="col-sm-2 control-label"><label class="control-label" for="claim-sud-file"></label></div><div class="col-sm-6"><input name="Claim[claimSudFile]" value="" type="hidden"><input id="claim-sud-file" class="hidden" name="Claim[claimSudFile]" type="file"></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                                </div>                        </td>
                            <td class="text-center " id="claim-sud-result" style="vertical-align: middle">
                                <span class="glyphicon glyphicon-remove" style="font-size: 1.4em;color: red;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Договор или соглашение, содержащие <a target="_blank" href="http://delovedsud.ru/appeal/">третейскую оговорку</a></td>
                            <td class="text-center ">

                                <button type="button" class="noFileOgovor btn create-btn btn-xs btn-success">Прикрепить файл</button>                            <div class="form-group field-claim-ogovor-file">
                                    <div class="col-sm-2 control-label"><label class="control-label" for="claim-ogovor-file"></label></div><div class="col-sm-6"><input name="Claim[claimOgovorFile]" value="" type="hidden"><input id="claim-ogovor-file" class="hidden" name="Claim[claimOgovorFile]" type="file"></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                                </div>                        </td>
                            <td class="text-center " id="claim-ogovor-result" style="vertical-align: middle">
                                <span class="glyphicon glyphicon-remove" style="font-size: 1.4em;color: red;"></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>


                <div class="form-group text-left" style="margin-left: 15px">
                    <button type="submit" class="btn create-btn btn-md btn-success create-claim" disabled="disabled">Создать</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/chat?id=1">Отмена</a>        </div>

            </div>
        </div>
    </div>
<?php elseif ($type == 3):?>
    <?php $this->title ='Открыть спор'?>
    <div class="dispute-create">
        <h3 class="text-left">Открытие Спора</h3>
        <div class="lead">Спор с предприятем: <a href="">ООО "АЛДА"</a></div>
        <div class="dispute-create">
            <div id="w0" class="form-horizontal" action="/admin/dispute/create?id=56" method="post">
                <input name="_csrf-frontend" value="N1hjWDRrbi5AH042Yj4KQXIPEmAAPgh6WggvaQcoOEp.FCVoWhwtFg==" type="hidden">
                <div class="form-group field-dispute-detailtext required">
                    <div class="col-sm-2 control-label"><label class="control-label" for="dispute-detailtext">Детальное описание</label></div><div class="col-sm-6"><textarea id="dispute-detailtext" class="form-control" name="Dispute[detailText]" maxlength="255" rows="5"></textarea></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                </div>        <hr>

                <div class="form-group text-left">
                    <button type="submit" class="btn create-btn btn-md btn-success">Создать</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/chat?id=1">Отмена</a>        </div>

            </div>
        </div>

    </div>

<?php elseif ($type == 4):?>
    <?php $this->title ='Задать вопрос юристу'?>
    <div class="goods-create">
        <h1 class="text-left">Задать вопрос юристу</h1>

        <div class="goods-create">
            <div id="w0" class="form-horizontal" >
                <div class="form-group field-consult-name required">
                    <div class="col-sm-3 control-label"><label class="control-label" for="consult-name">Детальное описание</label></div><div class="col-sm-5"><textarea id="consult-name" class="form-control" name="Consult[name]" maxlength="255" rows="4" placeholder=""></textarea></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                </div>        <hr>

                <div class="form-group text-left">
                    <button type="submit" class="btn create-btn btn-md btn-success">Создать</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/consult">Отмена</a>        </div>

            </div>
        </div>

    </div>
<?php elseif ($type == 5):?>
    <?php $this->title ='Cоздать обращение в службу поддержки'?>
    <div class="ticket-create">
        <h1 class="text-left">Cоздать обращение в службу поддержки</h1>

        <div class="ticket-create">
            <div id="w0" class="form-horizontal">
                <div class="form-group field-ticket-name required">
                    <div class="col-sm-3 control-label"><label class="control-label" for="ticket-name">Детальное описание</label></div><div class="col-sm-5"><textarea id="ticket-name" class="form-control" name="Ticket[name]" maxlength="255" rows="4" placeholder="Укажите точно ваш вопрос или ошибку, которую вы обнаружили."></textarea></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                </div>        <hr>

                <div class="form-group text-left">
                    <button type="submit" class="btn create-btn btn-md btn-success">Создать</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/ticket">Отмена</a>        </div>

            </div>
        </div>

    </div>

<?php elseif ($type == 6):?>
    <?php $this->title ='Написать отзыв'?>
    <div class="ticket-create">
        <h1 class="text-left">Написать отзыв</h1>

        <div class="ticket-create">
            <div id="w0" class="form-horizontal">
                <div class="form-group field-ticket-name required">
                    <div class="col-sm-3 control-label"><label class="control-label" for="ticket-name">Описание отзыва</label></div><div class="col-sm-5"><textarea id="ticket-name" class="form-control" name="Ticket[name]" maxlength="255" rows="4" placeholder=""></textarea></div><div class="row"><div class="col-sm-5 col-sm-offset-3"><p class="help-block help-block-error"></p></div></div>
                </div>        <hr>

                <div class="form-group text-left">
                    <button type="submit" class="btn create-btn btn-md btn-success">Отправить</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/chat?id=1">Отмена</a>        </div>

            </div>
        </div>

    </div>
<?php endif;?>