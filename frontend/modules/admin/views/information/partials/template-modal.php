<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 17.10.17
 * Time: 14:23
 */
?>
<div class="modal fade" id="modal-arbitration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block; padding-right: 16px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content arbitration">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="i-times"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body text-left">
                <h3><?=$data['Дело']?> <?=$data['Тип']?></h3>
                <table class="table" style="max-width:700px;">
                    <tbody><tr>
                        <td width="250">Категория дела</td>
                        <td><?=$data['Категория']?></td>
                    </tr>
                    <tr>
                        <td width="250">Дата регистрации заявления</td>
                        <td><?=$data['ДатаСтарт']?></td>
                    </tr>
                    </tbody></table>
                <table class="table" style="max-width:1300px;">
                    <caption>Участники дела</caption>
                    <thead>
                    <tr>
                        <td>Наименование</td>
                        <td>ИНН</td>
                        <td>ОГРН</td>
                        <td>Категория</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="5"><b>Истец</b></td>
                    </tr>
                    <tr>
                        <?php if(isset($data['Участники']['Истец'])):?>
                        <td width="400">
                            <?=$data['Участники']['Истец'][0]['Наименование']?></td>
                        <td width="150">
                            <?=$data['Участники']['Истец'][0]['ИНН']?> </td>
                        <td width="150">
                            <?=$data['Участники']['Истец'][0]['ОГРН']?> </td>
                        <td><?=$data['Участники']['Истец'][0]['Категория']?></td>
                        <?php endif;?>
                    </tr>
                    <tr>
                        <td colspan="5"><b>Ответчик</b></td>
                    </tr>
                    <tr>
                        <?php if(isset($data['Участники']['Ответчик'])):?>
                        <td width="400">
                            <?=$data['Участники']['Ответчик'][0]['Наименование']?> </td>
                        <td width="150">
                            <?=$data['Участники']['Ответчик'][0]['ИНН']?> </td>
                        <td width="150">
                            <?=$data['Участники']['Ответчик'][0]['ОГРН']?> </td>
                        <td><?=$data['Участники']['Ответчик'][0]['Категория']?></td>
                        <?php endif;?>
                    </tr>
                    </tbody>
                </table>
                <table class="table" style="max-width:1300px;">
                    <caption>Хронология дела</caption>
                    <thead>
                    <tr>
                        <td>Дата</td>
                        <td>Документ</td>
                    </tr>
                    <?php foreach ($data['Хронология'] as $datum):?>
                    <tr>
                        <td colspan="5"><b><?=$datum['name']?></b></td>
                    </tr>
                    <?php foreach ($datum['docs'] as $key => $value):?>
                    <tr>
                        <td><?=$key?></td>
                        <td><?=$value?></td>
                    </tr>
                    <?php endforeach;?>
                    <?php endforeach;?>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
