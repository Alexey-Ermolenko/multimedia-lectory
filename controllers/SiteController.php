<?php

namespace app\controllers;

use app\components\UserHelperClass;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

use app\models\SignupForm;

use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\data\ActiveDataProvider;
use app\models\Lections;
use app\models\Contact;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    public function actionGetimg($text) {
        header('Content-type: image/jpeg');
        $image = UserHelperClass::getTextImage($text);
        echo $image;
        exit;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /*
        $dataProvider = new ActiveDataProvider([
            'query' => Lections::find()->where(['is_active' => 1]),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_date' => SORT_DESC,
                    'id' => SORT_DESC,
                ]
            ],
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,

        ]);
        */

        $query = Lections::find()->where(['is_active' => 1]);

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 12,
            'defaultPageSize' => 12
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionOut()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return Response|string
     */
    public function actionAbout()
    {
        //ML_TODO: actionAbout
        $model = new Contact();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $contact = Yii::$app->request->post();
            //UserHelperClass::pre(Yii::$app->request->post());
            //die();

            $model->sendEmail('contactMail', 'Мультимедиа-лекторий - Сообщение сайта', [
                'params' => $contact
            ]);

            Yii::$app->session->setFlash('aboutFormSubmitted');
            //return $this->render('about', ['model' => $model]);
            return $this->render('about', ['model' => $model]);
        } else {
            return $this->render('about', ['model' => $model]);
        }
    }

    public function actionSearch($q = null)
    {
        $query = Lections::find()
            ->filterWhere(['like', 'name', $q])
            ->orFilterWhere(['like', 'description', $q])
            ->orFilterWhere(['like', 'keywords', $q])
            ->orFilterWhere(['like', 'content', $q])
            ->orFilterWhere(['like', 'task_group', $q])
            ->orFilterWhere(['like', 'autor', $q])
            ->orFilterWhere(['like', 'created_date', $q])
            ->orFilterWhere(['like', 'update_date', $q])
            ->andWhere(['is_active' => 1])
            ->orderBy('id DESC');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'q' => $q
        ]);
    }


    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
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
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /*
	//http://lectory.yii/site/add-admin
    public function actionAddAdmin() {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->role = '20';
            $user->email = 'admin@admin.admin';
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }
    */
}
