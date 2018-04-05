<?php
/**
 * @var $this \yii\web\View
 */

/**
 * @var $paymentRequest \common\models\PaymentRequest
 */

use frontend\assets\BillAsset;

$this->title = 'Счет на оплату';
BillAsset::register($this);
?>

<table width="40%" style="margin-top: 2%" align="center" border=0 cellspacing=0 cellpadding="0">
    <tr>
        <td width="10" ></td>
        <td width="27" ></td>
        <td width="163" ></td>
        <td width="133" ></td>
        <td width="60" ></td>
        <td width="70" ></td>
        <td width="100" ></td>
        <td width="100" ></td>
    </tr>
    <tr>
        <td >
        <td colspan=7><b><u>Группа компаний "Эйдинг" (ООО)</u></b><br>
            <br><b>Адресс: 656049, Алтайский край, Барнаул г, Папанинцев ул, д.97</b>
            <br>
            <br>
        </td>
    </tr>

    <tr>
        <td >
        <td align=center colspan=7><b>Образец заполнения платежного поручения</b></td>
    </tr>
    <tr>
        <td >
        <td class="t l" colspan=2>ИНН 2221121409</td>
        <td class="t l" colspan=2>КПП 222501001</td>
        <td class="t l" align=center valign=bottom rowspan="3">Сч. №</td>
        <td class="t l r" valign=bottom rowspan="3" colspan="2">40702810600290005592</td>
    </tr>
    <tr>
        <td >
        <td class="t l" colspan="4">Получатель
    </tr>
    <tr>
        <td ></td>
        <td class="l" valign=top colspan=4>Группа компаний "Эйдинг" (ООО)</td>
    </tr>
    <tr>
        <td ></td>
        <td class="t l" colspan="4">Банк получателя</td>
        <td class="t l" align=center >БИК</td>
        <td class="t l r" colspan="2">045004783</td>
    </tr>
    <tr>
        <td ></td>
        <td class="l b" valign=top colspan=4>Ф-Л ГПБ (ОАО) в г.Новосибирске г.Новосибирск</td>
        <td class="t l b" align=center valign=top>Сч. №</td>
        <td class="l b r" valign=top colspan="2">30101810400000000783</td>
    </tr>
    <tr>
        <td ></td>
        <td colspan="7" >&nbsp;</td>
    </tr>
    <tr>
        <td ></td>
        <td align=center colspan=7><b><font size="4">СЧЕТ № <?=$paymentRequest->id?> от <?=$paymentRequest->date_created?><br>
                    <br>
                </font></b>
    </tr>
    <tr>
        <td ></td>
        <td colspan="2">Плательщик:</td>
        <td colspan="5"><?=$paymentRequest->account->orgForm->code ?> <?=$paymentRequest->account->full_name?></td>
    </tr>
    <tr>
        <td ></td>
        <td colspan="2">Грузополучатель:</td>
        <td colspan="5"><?=$paymentRequest->account->orgForm->code ?> <?=$paymentRequest->account->full_name?></td>
    </tr>
    <tr>
        <td ></td>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td ></td>
        <td class="t l" align=center >№</td>
        <td class="t l" align=center colspan=2>Наименование товара</td>
        <td class="t l" align=center>Единица<br>изме-<br>рения</td>
        <td class="t l" align=center >Коли-<br>чество<br></td>
        <td class="t l" align=center >Цена</td>
        <td class="t l r" align=center >Сумма</td>
    </tr>
    <tr>
        <td ></td>
        <td class="t l" align=right valign=top>1</td>
        <td class="t l" valign=top colspan=2>Оплата услуг за доступ к порталу "Деловед"</td>
        <td class="t l" align=center>шт</td>
        <td class="t l" align=right>1</td>
        <td class="t l" align=right><?=$paymentRequest->value?> Руб.</td>
        <td class="t l r" align=right><?=$paymentRequest->value?> Руб.</td>
    </tr>
    <tr>
        <td ></td>
        <td class="t" align=right colspan="6" ><b>Итого:</b>
        <td class="t l r" align=right ><b><?=$paymentRequest->value?> Руб.</b>
    </tr>
    <tr>
        <td ></td>
        <td align=right colspan="6"><b>Без налога (НДС).</b>
        <td class="t l r" align=center >-
    </tr>
    <tr>
        <td ></td>
        <td align=right colspan="6"><b>Всего к оплате:</b>
        <td class="t l r b" align=right ><b><?=$paymentRequest->value?> Руб.</b>
    </tr>
    <tr>
        <td ></td>
        <td colspan=7><br>
            Всего наименований 1, на сумму <?=$paymentRequest->value?> Руб.
        </td>
    </tr>

    <tr>
        <td ></td>
    </tr>

    <tr>
        <td ></td>
        <td colspan="7">Руководитель предпрития

            <div style="width: 260px; height: 70px; display: inline-block; border-bottom:1.5px solid #000000; margin: 0;" align="center">

                <img src="/images/sign1.png"/>

            </div>

            (Проскуряков П.В.)

            <br></td>
    </tr>

    <tr>
        <td ></td>
        <td colspan="7">Главный бухгалтер

            <div style="width: 300px; height: 70px; display: inline-block; border-bottom:1.5px solid #000000; margin: 0;" align="center">

                <img src="/images/sign2.png"/>


            </div>

            (Кирей Т.И.)<br>
            <br></td>
    </tr>
    <tr>
        <td ></td>
        <td valign=top colspan=7>
            <img src="/images/admin/Shtamp.png"/>
        </td>
    </tr>
</table>
