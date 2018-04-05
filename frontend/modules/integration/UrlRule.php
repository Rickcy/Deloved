<?php


namespace frontend\modules\integration;



use common\models\Logs;
use frontend\helpers\ModuleHelper;

class UrlRule extends \yii\web\UrlRule
{
    public $route = 'integration/default/<mode>';
    public $pattern = 'integration/1c-exchange';

    public function init()
    {

        $this->route = ModuleHelper::getModuleNameByClass('frontend\modules\integration\IntegrationModule', 'integration') . '/default/<mode>';
        parent::init();
    }

    public function parseRequest($manager, $request)
    {
//        $log = new Logs();
//        $log->logs = $request->getUserHost().''.$request->getUserIP();
//        $log->save();

        if($request->getUrl() === '/integration/1c-exchange'){
            $request->setUrl('/integration/1c-exchange/index');
        }
        $this->defaults = ['mode' => \Yii::$app->request->get('mode', 'index')];
        return parent::parseRequest($manager, $request);
    }
}