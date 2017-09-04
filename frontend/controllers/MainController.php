<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 13.08.17
 * Time: 21:12
 */

namespace frontend\controllers;


use frontend\models\EmailConfirmForm;
use frontend\models\ResetPasswordForm;
use PhpOffice\PhpWord\PhpWord;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class MainController extends Controller
{
    public $layout='/main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],

                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex(){



        return $this->render('index');
    }

    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user = $model->confirmEmail()) {
            if (Yii::$app->getUser()->login($user)) {
                Yii::$app->session->addFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
                return $this->redirect('/admin');
            }
            return $this->goHome();
        } else {
            Yii::$app->session->addFlash('error', 'Ошибка подтверждения Email.');
        }

        return $this->goHome();
    }



    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws \yii\base\InvalidParamException
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->addFlash('success', 'Новый пароль сохранен!');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }




}