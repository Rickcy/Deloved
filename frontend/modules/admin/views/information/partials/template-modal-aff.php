<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 21.02.18
 * Time: 16:01
 */
?>
<div class="modal fade" id="modal-aff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block; padding-right: 16px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content arbitration">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="i-times"></i></span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body text-left">
                <h3 class="text-center">Связанные компании по учредителю</h3>

                <table class="table" style="max-width:1300px;">

                    <thead>
                    <tr>
                        <td>Наименование</td>
                        <td>Активность</td>
                        <td>ИНН</td>
                        <td>Дата Создания</td>
                        <td>Адрес</td>
                        <td>Деятельность</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['docs'] as $comp):?>
                    <tr>
                        <?php if ($comp['ТипДокумента'] == 'ul'):?>
                        <td><?=$comp['НаимЮЛПолн']?></td>
                        <td><?=$comp['Активность']?></td>
                        <td  ><a data-dismiss="modal" href="javascript:void(0)" class="check-inn" check-inn="<?=$comp['ИНН']?>"><?=$comp['ИНН']?></a></td>
                        <td><?=$comp['ОбрДата']?></td>
                        <td><?=$comp['Адрес']?></td>
                        <td><?=$comp['НаимОКВЭД']?></td>
                         <?php endif;?>
                        <?php if ($comp['ТипДокумента'] == 'ip'):?>
                            <td><?=$comp["НаимВидИП"].' '.$comp["Фамилия"].' '.$comp["Имя"]?></td>
                            <td><?=$comp['Активность']?></td>
                            <td><?=$comp["ИННФЛ"]?></td>
                            <td><?=$comp["ДатаОГРНИП"]?></td>
                            <td></td>
                            <td><?=$comp['НаимОКВЭД']?></td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
