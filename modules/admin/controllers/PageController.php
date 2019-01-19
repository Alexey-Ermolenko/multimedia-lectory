<?php

namespace app\modules\admin\controllers;


use app\models\UserSearch;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;


use yii\data\SqlDataProvider;




/**
 * Default controller for the `admin` module
 */
class PageController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'user', 'index', 'user-edit', 'user-list'],
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
                    [
                        'actions' => ['user' , 'index', 'user-edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['user-list'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUser()
    {
        return $this->render('user');
    }    
	
	public function actionUserEdit()
    {
        if (Yii::$app->request->isPost)
        {
            $user = Yii::$app->request->post('user');
            $model = User::findOne($user['id']);
            //ML_TODO: загрузка файла
            if (!empty($_FILES['img_src']['tmp_name']))
            {
                $uploadPath = 'upload/users/'.$user['id'].'/';
                if (is_dir($uploadPath))
                {
                    //загрузка файла
                    $filename=basename($_FILES['img_src']['name']);
                    $newFileName='avatar'.substr($filename, strpos($filename,'.'), strlen($filename)-1);
                    $uploadfile = $uploadPath . $newFileName;
                    //удаление предыдущего файла
                    (!empty($model->img_src)) ? unlink($model->img_src) : '';
                    if (!move_uploaded_file($_FILES['img_src']['tmp_name'], $uploadfile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadfile;
                    }
                } else {
                    mkdir($uploadPath);
                    if (is_dir($uploadPath))
                    {
                        //загрузка файла
                        $filename=basename($_FILES['img_src']['name']);
                        $newFileName='avatar'.substr($filename, strpos($filename,'.'), strlen($filename)-1);
                        $uploadfile = $uploadPath . $newFileName;
                        //удаление предыдущего файла
                        (!empty($model->img_src)) ? unlink($model->img_src) : '';
                        if (!move_uploaded_file($_FILES['img_src']['tmp_name'], $uploadfile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadfile;
                        }
                    }
                }
                $user['img_src']=$uploadfile;
            }
            $model->setAttributes($user, false);
            if ($model->save())
            {
                //при обновлении данных меняем фото пользователя
                //перенаправление на страницу user-edit
                return $this->goBack('user-edit');

            } else {
                Yii::$app->userHelperClass->pre('error');
            }

        } else {
            return $this->render('user-edit');
        }
    }

    public function actionAdminUserEdit($id) {
        if (Yii::$app->request->isPost)
        {
            $user = Yii::$app->request->post('user');
            $model = User::findOne($user['id']);
            //ML_TODO: загрузка файла
            //ML_TODO: Дублирование кода как в actionUserEdit()
            if (!empty($_FILES['img_src']['tmp_name']))
            {
                $uploadPath = 'upload/users/'.$user['id'].'/';
                if (is_dir($uploadPath))
                {
                    //загрузка файла
                    $filename=basename($_FILES['img_src']['name']);
                    $newFileName='avatar'.substr($filename, strpos($filename,'.'), strlen($filename)-1);
                    $uploadfile = $uploadPath . $newFileName;
                    //удаление предыдущего файла
                    (!empty($model->img_src)) ? unlink($model->img_src) : '';
                    if (!move_uploaded_file($_FILES['img_src']['tmp_name'], $uploadfile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadfile;
                    }
                } else {
                    mkdir($uploadPath);
                    if (is_dir($uploadPath))
                    {
                        //загрузка файла
                        $filename=basename($_FILES['img_src']['name']);
                        $newFileName='avatar'.substr($filename, strpos($filename,'.'), strlen($filename)-1);
                        $uploadfile = $uploadPath . $newFileName;
                        //удаление предыдущего файла
                        (!empty($model->img_src)) ? unlink($model->img_src) : '';
                        if (!move_uploaded_file($_FILES['img_src']['tmp_name'], $uploadfile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadfile;
                        }
                    }
                }
                $user['img_src']=$uploadfile;
            }
            $model->setAttributes($user, false);
            if ($model->save())
            {
                //при обновлении данных меняем фото пользователя
                //перенаправление на страницу user-list
                return $this->goBack('user-list');

            } else {
                Yii::$app->userHelperClass->pre('error');
            }

        }
        else
        {
            $model = User::findOne($id);
            return $this->render(
                'admin-user-edit',
                [
                    'id' => $id,
                    'model' => $model
                ]
            );
        }
    }

    public function actionAdminUserDel($id = false)
    {
        if (isset($id))
        {
            if (Yii::$app->user->identity->role == \app\models\User::ROLE_ADMIN)
            {
                if (User::deleteAll(['in', 'id', $id]))
                {
                    $this->redirect(['user-list']);
                }
            }
        }
        else
        {
            $this->redirect(['user-list']);
        }
    }

	public function actionUserList()
    {
        /*
        $userModel = User::find()->all();
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM user',

            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'username',
                    'role',
                    'email',
                    'created_at',
                ],
            ],
        ]);

        return $this->render('user-list', ['userModel' => $userModel, 'provider'=> $provider]);
        */

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=15;

        return $this->render('user-list', [
            'userModel' => $searchModel,
            'provider' => $dataProvider,
        ]);
    }
}
