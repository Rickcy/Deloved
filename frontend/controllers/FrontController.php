<?php
namespace frontend\controllers;

use common\models\Account;
use common\models\Category;
use common\models\CategoryType;
use common\models\OrgForm;
use common\models\Profile;
use common\models\Region;
use common\models\Role;
use common\models\User;
use Faker\Provider\DateTime;
use frontend\models\EmailConfirmForm;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * @var $profile \common\models\Profile
 * Front controller
 */
class FrontController extends Controller
{
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

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
//        $user = User::findOne(Yii::$app->user->id);
//        $profiles=$user->getProfiles()->one();
//
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionLogin()
    {


        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) ) {
           
            $model->login();
            return $this->redirect('/admin');
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->remove('timeZone');
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionContact()
    {
        $model = new ContactForm();
       
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionSignup()
    {

      $categoryType = CategoryType::find()->all();
      $category = Category::find()->all();
        
       $level_id=18;
       $org_forms =OrgForm::find()->all();
        $city_list=Region::find()
           ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
           ->asArray()
           ->all();

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {


            if ($user = $model->signup()) {
               

                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('/admin');
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,'city_list'=>$city_list,'org_forms'=>$org_forms,'categoryType'=>$categoryType,'category'=>$category
        ]);
    }


    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user =$model->confirmEmail()) {
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
     * Requests password reset.
     *
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
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
