<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 31.08.17
 * Time: 23:59
 */

namespace frontend\models;


use common\models\Account;
use common\models\Measure;
use PhpOffice\PhpWord\PhpWord;
use Yii;
use yii\base\Model;

class DocumentForm extends Model
{
    const SCENARIO_СONTRACT_FOR_SERVICES = 'contract-for-services';
    const SCENARIO_DELIVERY_CONTRACT = 'delivery-contract';


    public $number;//номер документа

    public $place_signing;//место подписания
    public $date_signing;//дата подписания

    public $inn_executor;//инн исполнителя
    public $inn_customer;//инн заказчика

    public $service_list;//перечень услуг
    public $attraction_co_executors;//превлечение испонителей
    public $date_service_delivery_begin;//дата начала оказания услуг
    public $date_service_delivery_end;//дата окончания оказания услуг

    public $location_services;//место оказания услуг
    public $compensation_expenses;//компенсация расходов
    public $cost;//стоимость


    public $VAT;//НДС
    public $payment_order;//порядок оплаты
    public $responsibility;//ответственность сторон


    /////------------------------------------


    public $good_name;
    public $assort;
    public $count;
    public $unit;//единица измерения
    public $tara;
    public $insurance_goods;
    public $transfer_goods;
    public $transfer_place;
    public $delivery_goods_costs;
    public $delivery_time;
    public $delivery_payment_order;



    public function rules()
    {
        return [
            [[
                'number',
                'place_signing',
                'date_signing',
                'inn_executor',
                'inn_customer',
                'service_list',
                'attraction_co_executors',
                'date_service_delivery_begin',
                'date_service_delivery_end',
                'location_services',
                'compensation_expenses',
                'cost',
                'unit',
                'VAT',
                'payment_order',
                'responsibility',
            ],'required'],
            [[
                'number',
                'place_signing',
                'date_signing',
                'inn_executor',
                'inn_customer',
                'service_list',
                'attraction_co_executors',
                'date_service_delivery_begin',
                'date_service_delivery_end',
                'location_services',
                'compensation_expenses',
                'cost',
                'unit',
                'VAT',
                'payment_order',
                'responsibility',
            ],'trim'],
            [[
                'place_signing',
                'inn_executor',
                'inn_customer',
                'service_list',
                'attraction_co_executors',
                'location_services',
                'compensation_expenses',
                'cost',
                'unit',
                'VAT',
                'payment_order',
                'responsibility',
            ],'string', 'max' => 200],

        ];
    }


    public static function listDeliveryPaymentOrder(){
        return[
            'Оплата до даты отгрузки.',
            'Оплата после отгрузки.',
            'Оплата частями в течение периода.',
        ];
    }

    public static function getDeliveryPaymentOrder($number){
        $list = [
            'Оплата Товара осуществляется  до момента отгрузки (передачи) Товара Покупателю авансом в размере _________________.',
            'Оплата Товара осуществляется  после передачи Товара Покупателю, не позднее ________ (_____________) банковских дней со дня подписания Сторонами товарной накладной.',
            'Оплата Товара осуществляется частями в следующем порядке:
- сумму в размере ________ (__________) рублей, Покупатель оплачивает до «___» _________ 20 __г. . 
- сумму в размере ________ (__________) рублей, Покупатель оплачивает до «___» _________ 20 __г.',
        ];
        return $list[$number];
    }

    public static function listDeliveryTime(){
        return[
            'Покупатель проинформирует о партии товара и сроках поставки.',
            'Поставка равными партиями в течении всего срока действия договора.',
            'Поставка не позднее определенной даты.',
        ];
    }

    public static function getDeliveryTime($number){
        $list = [
            'Покупатель не позднее чем за ____ дней до предполагаемой даты поставки направляет Поставщику заявку с указанием срока поставки и партии Товара.',
            'Поставщик поставляет Товар одинаковыми партиями помесячно в течение всего срока действия Договора.',
            'Поставка Товара должна быть осуществлена в полном объеме не позднее «__» _______ 20__ г.".',
        ];
        return $list[$number];
    }


    public static function listTransferPlace(){
        return[
            'Товар передается по адресу нахождения Покупателя ',
            'Товар передается по адресу нахождения Поставщика',
            'Товар по отдельному адресу. ',
        ];
    }

    public static function getTransferPlace($number){
        $list = [
           0=> 'Товар передается Покупателю по месту нахождения Покупателя по адресу, указанному в разделе 10 «Адреса и подписи сторон» настоящего Договора.',
           1=> 'Товар передается Покупателю по месту нахождения Поставщика по адресу: указанному в разделе 10 «Адреса и подписи сторон» настоящего Договора.',
           2=> 'Поставщик передаст Товар Покупателю по адресу: _______________________________.',
        ];
        return $list[$number];
    }


    public static function listDeliveryGoodsCosts(){
        return[
            'Доставка силами поставщика без дополнительной оплаты.',
            'Доставка силами поставщика за дополнительную оплату.',
            'Самовывоз за счет покупатель.',
            'Доставка силами перевозчика за счет Покупателя.',
            'Доставка силами перевозчика за счет Поставщика.',
        ];
    }


    public static function getDeliveryGoodsCosts($number){
        $list = [
            'Товар доставляется силами Поставщика. Стоимость доставки входит в стоимость Товара.',
            'Товар доставляется силами Поставщика. Стоимость доставки оплачивает Покупатель.',
            'Покупатель осуществляет самовывоз Товара своими силами и за свой счет.',
            'Доставка Товара осуществляется перевозчиком за счет Покупателя. ',
            'Доставка Товара осуществляется перевозчиком за счет Поставщика. ',
        ];

        return $list[$number];
    }

    public static function listTransferGoods(){
        return[
            'Товар передается по адресу нахождения Покупателя.',
            'Товар передается по адресу нахождения Поставщика.',
            'Товар по отдельному адресу. ',
        ];
    }

    public static function getTransferGoods($number){
        $list =[
            'Поставка Товара осуществляется Поставщиком путем отгрузки непосредственно Покупателю.',
            'Поставка Товара осуществляется Поставщиком путем отгрузки перевозчику, указанному в отгрузочной разнарядке.
            В отгрузочной разнарядке указывается точный адрес получателя и/или покупателя, его наименование, банковские реквизиты и нормы отгрузки Товара. Отгрузочная разнарядка направляется в течение трех дней до наступления периода поставки.',
            'Поставка Товара осуществляется Поставщиком путем отгрузки получателям, указанным Покупателем в отгрузочной разнарядке.
            В отгрузочной разнарядке указывается точный адрес получателя, его наименование, банковские реквизиты и нормы отгрузки Товара. Отгрузочная разнарядка направляется в течение трех дней до наступления периода поставки',
        ];
        return $list[$number];
    }



    public static function listInsuranceGoods(){
        return[
            'Товар не страхуется ',
            'Поставщик страхует товар, выгодоприобретателем по договору страхования является Поставщик.',
            'Поставщик страхует товар, выгодоприобретателем по договору страхования является Покупатель.',
            'Покупатель страхует товар, выгодоприобретателем по договору страхования является Поставщик.',
            'Покупатель страхует товар, выгодоприобретателем по договору страхования является Покупатель.',
        ];
    }

    public static function getInsuranceGoods($number){
        $list = [
            'Настоящим договором Стороны определили, что обязанность по страхования у Сторон отсутствует. ',
            'Стороны пришли к соглашению, что обязанность по страхованию Товара на сумму __________ лежит на Поставщике. Договор страхования должен быть заключен до осуществления Поставщиком передачи Товара. Страховая премия включена в стоимость Товара. Выгодоприобретателем по договору страхования является Поставщик.',
            'Стороны пришли к соглашению, что обязанность по страхованию Товара на сумму __________ лежит на Поставщике. Договор страхования должен быть заключен до осуществления Поставщиком передачи Товара. Страховая премия включена в стоимость Товара. Выгодоприобретателем по договору страхования является Покупатель.',
            'Стороны пришли к соглашению, что обязанность по страхованию Товара на сумму __________ лежит на Покупателе. Договор страхования должен быть заключен до осуществления Поставщиком передачи Товара. Выгодоприобретателем по договору страхования является Поставщик.',
            'Стороны пришли к соглашению, что обязанность по страхованию Товара на сумму __________ лежит на Покупателе. Договор страхования должен быть заключен до осуществления Поставщиком передачи Товара. Выгодоприобретателем по договору страхования является Покупатель.',
        ];
       return $list[$number];
    }

    public static function listTara(){
        return[
            'Тара и упаковка не возвращаются.',
            'Покупатель возвращает оборотную тару.',
            'Покупатель возвращает тару самовывозом поставщика.',
        ];
    }

    public static function getTara($number){
        $list = [
            'Стороны согласовали необходимость затаривания и упаковки Товара обычным для такого Товара способом, обеспечивающим сохранность Товара при условиях хранения и транспортирования, предусмотренных Договором. Тара не является возвратной. Стоимость тары входит в стоимость Товара.',
            'Стороны согласовали необходимость затаривания и упаковки Товара обычным для такого Товара способом, обеспечивающим сохранность Товара при условиях хранения и транспортирования, предусмотренных Договором. Покупатель обязан возвратить оборотную тару и средства пакетирования, в которых осуществлена поставка Товара в течении ________ дней  с даты поставки Товара.',
            'Стороны согласовали необходимость затаривания и упаковки Товара обычным для такого Товара способом, обеспечивающим сохранность Товара при условиях хранения и транспортирования, предусмотренных Договором. Тара после принятия Товара подлежит возврату Поставщику. Возврат тары осуществляется Поставщиком путем самовывоза от Покупателя.',
        ];
        return $list[$number];
    }


    public static function listResponsibility(){
        return [
            'Общая ответственность сторон, предусмотренная законом.',
            'Пеня за нарушение сроков Исполнителем.',
            'Пеня за нарушение сроков оплаты Заказчиком',
            'Штраф Заказчику за нарушение сроков передачи документов и информации.',
            'Штраф Исполнителю за нарушение сроков передачи документов и информации.',
            'Исполнитель несет ответственность за сохранность документов',
        ];
    }

    public static function getResponsibility($numbers){
        $num  = '5.1';
        $n = 0;
        $list =  [
            'За невыполнение обязательств по настоящему договору Стороны несут  имущественную ответственность в соответствии с законодательством РФ.',
            'За нарушение сроков исполнения обязательств по настоящему Договору, Исполнитель выплачивает Заказчику пени в размере 0,1% от стоимости несвоевременно оказанных  Услуг за каждый день просрочки. При этом оплата пени не освобождает Исполнителя от  выполнения обязательств по настоящему Договору.',
            'За нарушение сроков исполнения обязательств  настоящего Договора, Заказчик выплачивает Исполнителю пени в размере 0,1% от неоплаченной суммы за каждый день просрочки. При этом оплата пени не освобождает Заказчика от  выполнения обязательств по настоящему Договору.',
            'В случае неисполнения (ненадлежащего исполнения) Заказчиком обязанностей, предусмотренных в Договоре Заказчик выплачивает Исполнителю штраф в  размере _______________ за каждый такой случай.',
            'В случае неисполнения (ненадлежащего исполнения) Исполнителем обязанностей, предусмотренных в Договоре Исполнитель выплачивает Заказчику штраф  в размере ________________ за каждый такой случай.',
            'Исполнитель несет ответственность за сохранность полученных от Заказчика оригиналов документов, и в случае утраты обязуется восстановить их за свой счет.',
        ];
        $l =[];
        foreach ($numbers as $number){
            $n++;
            $l[]=$num.'.'.$n.' '.$list[$number];
        }

        return implode(PHP_EOL,$l);

    }


    public static function listCoExecutors(){
        return [
            'Соисполнители не привлекаются.',
            'Соисполнитель привлекается с согласия Заказчика.',
            'Участие соисполнителя на усмотрения Исполнителя.'
        ];
    }

    public static function listVAT(){
        return [
            'Цена включает НДС 10%',
            'Цена включает НДС 18%',
            'Цена не включает НДС 10%',
            'Цена не включает НДС 18%',
            'Поставщик не является плательщиком НДС',
        ];
    }


    public static function listPaymentOrder(){
        return [
            '100% предварительная оплата.',
            'Оплата после получения исполнения.',
            'Частичная предоплата и последующая оплата.',
            'Оплата частями в течение периода.',
        ];
    }


    public static function getPaymentOrder($number){
        $list =    [
            0=>'Оплата Услуг по Договору осуществляется в порядке 100% предоплаты.',
            1=>'Оплата Услуг по Договору осуществляется в следующем порядке:
 	 - предоплата в срок до«___» __________ ____ в сумме _________________ 
     - окончательный расчет осуществляется в течение 5 банковских дней со дня осуществлениями Сторонами сдачи-приема Услуг в соответствии с условиями Договора.',
            2=>'Оплата Услуг по Договору осуществляется ежемесячно равными долями в размере ________________
                    в течение 5 банковских дней со дня окончания расчетного месяца.',
            3=>' Оплата Услуг по Договору осуществляется в следующем порядке:
 	 - предоплата в срок до«___» ______________  ______ 
 	 в сумме __________________ 
 	  - оставшаяся часть ежемесячно равными долями в сумме ______________________ в течение 5 банковских дней со дня окончания расчетного месяца.',
        ];
        return $list[$number];
    }

    public static function getVAT($number){
        $list =   [
           0=>'Цена включает НДС 10%',
           1=>'Цена включает НДС 18%',
           2=>'Цена не включает НДС 10%',
           3=> 'Цена не включает НДС 18%',
           4=> 'Поставщик не является плательщиком НДС',
        ];
        return $list[$number];

    }


    public static function listCompensationExpenses(){
        return [
            'Заказчик возместит расходы Исполнителя.',
            'Заказчик возместит предварительно согласованные расходы.',
            'Заказчик не возмещает расходы.'
        ];
    }

    public static function getCompensationExpenses($number){
        $list =  [
           0=>'Возместить Исполнителю расходы, понесенные последним.',
           1=>'Возместить Исполнителю расходы, понесенные последним, в случае если расходы были предварительно согласованы с Заказчиком.',
           2=>'Заказчик вправе не возмещать Исполнителю расходы, понесенные последним при оказании Услуг по Договору.'
        ];
        return $list[$number];
    }


    public static function getCoExecutors($number){
        $list = [
            0=>'Исполнитель оказывает Услуги лично.',
            1=>'Исполнитель вправе привлекать третье лицо (соисполнителя) только с письменного согласия Заказчика.',
            2=>'Для оказания Услуг Исполнитель вправе привлечь третье лицо (соисполнителя) по своему выбору.'
        ];
        return $list[$number];
    }

    public function scenarios()
    {
        return[
            self::SCENARIO_СONTRACT_FOR_SERVICES =>[
                'number',
                'place_signing',
                'date_signing',
                'inn_executor',
                'inn_customer',
                'service_list',
                'attraction_co_executors',
                'date_service_delivery_begin',
                'date_service_delivery_end',
                'location_services',
                'compensation_expenses',
                'cost',
                'VAT',
                'payment_order',
                'responsibility',
            ],
            self::SCENARIO_DELIVERY_CONTRACT => [
                'number',
                'place_signing',
                'date_signing',
                'inn_executor',
                'inn_customer',
                'good_name',
                'unit',
                'assort',
                'count',
                'tara',
                'insurance_goods',
                'transfer_goods',
                'delivery_goods_costs',
                'delivery_time',
                'delivery_payment_order',
                'date_service_delivery_end',
            ]
        ];
    }


    public function saveСontractForServices(){
        $account_executor = Account::findOne(['inn'=>$this->inn_executor]);
        $account_customer = Account::findOne(['inn'=>$this->inn_customer]);
        $docx = new PHPWord();
        $document = $docx->loadTemplate(Yii::getAlias('@frontend').'/web/docsTemplate/Договор Услуг.docx');
        $document->setValue('number', $this->number);
        $document->setValue('place_signing', $this->place_signing);
        $document->setValue('date_signing', $this->date_signing);
        $document->setValue('company_executor', $account_executor->orgForm->code.' '.$account_customer->brand_name);
        $document->setValue('fio_executor', $account_executor->director);
        $document->setValue('company_customer', $account_customer->orgForm->code.' '.$account_customer->brand_name);
        $document->setValue('fio_customer', $account_customer->director);
        $document->setValue('service_list', $this->service_list);
        if($this->compensation_expenses ==1){
            $document->setValue('compensation_expenses_1','2.2.4.'. self::getCompensationExpenses($this->compensation_expenses));
        }
        if ($this->compensation_expenses == 0){
            $document->setValue('compensation_expenses_1','2.2.4.'. self::getCompensationExpenses($this->compensation_expenses));
        }

        if($this->compensation_expenses == 2){
            $document->setValue('compensation_expenses_2','2.3.1'. self::getCompensationExpenses($this->compensation_expenses));
            $document->setValue('compensation_expenses_2_n_1', '2.3.2');
            $document->setValue('compensation_expenses_2_n_2', '2.3.3');
            $document->setValue('compensation_expenses_1', '');
        }else{
            $document->setValue('compensation_expenses_2_n_1', '2.3.1');
            $document->setValue('compensation_expenses_2_n_2', '2.3.2');
            $document->setValue('compensation_expenses_2', '');
        }

        $document->setValue('attraction_co_executor', self::getCoExecutors((integer)$this->attraction_co_executors));
        $document->setValue('date_service_delivery_begin', $this->date_service_delivery_begin);
        $document->setValue('date_service_delivery_end', $this->date_service_delivery_end);
        $document->setValue('location_services', $this->location_services);
        $document->setValue('responsibility', self::getResponsibility($this->responsibility));
        if($this->VAT == 0) {
            $this->cost  =  $this->cost+round($this->cost/100*10);
        }
        if($this->VAT == 1) {
            $this->cost  =  $this->cost+round($this->cost/100*18);
        }

        $document->setValue('cost', ($this->cost));

        $document->setValue('VAT', self::getVAT($this->VAT));
        $document->setValue('company_executor_opf', $account_executor->orgForm->name);
        $document->setValue('company_executor_name', $account_executor->full_name);
        $document->setValue('company_executor_address', $account_executor->city->name.' '.$account_executor->legal_address);
        $document->setValue('company_executor_inn', $account_executor->inn);
        $document->setValue('company_executor_ogrn', $account_executor->ogrn);
        $document->setValue('company_executor_director', $account_executor->director);
        $document->setValue('company_customer_opf', $account_customer->orgForm->name);
        $document->setValue('company_customer_name', $account_customer->full_name);
        $document->setValue('company_customer_address', $account_customer->city->name.' '.$account_customer->legal_address);
        $document->setValue('company_customer_inn', $account_customer->inn);
        $document->setValue('company_customer_ogrn', $account_customer->ogrn);
        $document->setValue('company_customer_director', $account_customer->director);
        $temp_file = $document->save();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=Договор_услуг.docx');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($temp_file));
        readfile($temp_file);
        unlink($temp_file);
    }


    public function saveDeliveryContract(){
        $account_executor = Account::findOne(['inn'=>$this->inn_executor]);
        $account_customer = Account::findOne(['inn'=>$this->inn_customer]);
        $measure = Measure::findOne($this->unit);
        $docx = new PHPWord();
        $document = $docx->loadTemplate(Yii::getAlias('@frontend').'/web/docsTemplate/Договор Поставки.docx');
        $document->setValue('number', $this->number);
        $document->setValue('place_signing', $this->place_signing);
        $document->setValue('date_signing', $this->date_signing);
        $document->setValue('company_executor', $account_executor->orgForm->code.' '.$account_customer->brand_name);
        $document->setValue('fio_executor', $account_executor->director);
        $document->setValue('company_customer', $account_customer->orgForm->code.' '.$account_customer->brand_name);
        $document->setValue('fio_customer', $account_customer->director);
        $document->setValue('good_name', $this->good_name);
        $document->setValue('assort', $this->assort);
        $document->setValue('count', $this->count);
        $document->setValue('unit',$measure->name );
        $document->setValue('tara', self::getTara((integer)$this->tara));
        $document->setValue('insurance_goods', self::getInsuranceGoods((integer)$this->insurance_goods));
        $document->setValue('transfer_goods',self::getTransferGoods((integer)$this->transfer_goods));
        $document->setValue('transfer_place',self::getTransferPlace((integer)$this->transfer_place));
        $document->setValue('delivery_goods_costs',self::getDeliveryGoodsCosts((integer)$this->delivery_goods_costs));
        $document->setValue('delivery_time',self::getDeliveryTime((integer)$this->delivery_time));
        $document->setValue('VAT',self::getVAT((integer)$this->VAT));
        $document->setValue('delivery_payment_order',self::getDeliveryPaymentOrder((integer)$this->delivery_payment_order));
        $document->setValue('date_service_delivery_end',$this->date_service_delivery_end);
        $document->setValue('company_executor_opf', $account_executor->orgForm->name);
        $document->setValue('company_executor_name', $account_executor->full_name);
        $document->setValue('company_executor_address', $account_executor->city->name.' '.$account_executor->legal_address);
        $document->setValue('company_executor_inn', $account_executor->inn);
        $document->setValue('company_executor_ogrn', $account_executor->ogrn);
        $document->setValue('company_executor_director', $account_executor->director);
        $document->setValue('company_customer_opf', $account_customer->orgForm->name);
        $document->setValue('company_customer_name', $account_customer->full_name);
        $document->setValue('company_customer_address', $account_customer->city->name.' '.$account_customer->legal_address);
        $document->setValue('company_customer_inn', $account_customer->inn);
        $document->setValue('company_customer_ogrn', $account_customer->ogrn);
        $document->setValue('company_customer_director', $account_customer->director);
        $temp_file = $document->save();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=Договор_поставки.docx');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($temp_file));
        readfile($temp_file);
        unlink($temp_file);
    }
}