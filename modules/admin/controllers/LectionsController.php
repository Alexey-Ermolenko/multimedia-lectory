<?php

namespace app\controllers;


namespace app\modules\admin\controllers;

use app\models\Video;
use app\models\VideoSearch;
use Yii;
use app\models\Lections;
use app\models\LectionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Scenarios;
use app\models\ScenariosSearch;

use app\models\Demonstrations;
use app\models\DemonstrationsSearch;
use yii\helpers\ArrayHelper;
use yii\data\SqlDataProvider;

use yii\data\Sort;

use yii\data\Pagination;
use app\models\Country;

use yii\filters\AccessControl;

/**
 * LectionsController implements the CRUD actions for Lections model.
 */
class LectionsController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    //echo "777";
                    Yii::$app->response->redirect(['site/login']);
                    //site/login
                    //throw new \Exception('У вас нет доступа к этой странице');
                },
                'only' => ['login', 'logout', 'signup', 'index', 'slides', 'scenario', 'video'],
                'rules' => [
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['index', 'slides', 'scenario', 'video'],
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
     * Lists all Lections models.
     * @return mixed
     */

    public function actionIndex()
    {
        #Yii::$app->userHelperClass->pre(array_merge(Yii::$app->request->queryParams, ['module'=>$this->module->id]));

        /*
        SELECT user.id, username, name, lections.id
        FROM lections
        LEFT JOIN user ON lections.user_id = user.id
        */
      //  $user_id = Yii::$app->user->id;
      //  $_GET['LectionsSearch']['user_id'] = $user_id;

        $searchModel = new LectionsSearch();
        $dataProvider = $searchModel->search(array_merge(Yii::$app->request->queryParams, ['module'=>$this->module->id]));

        //$userModel = Lections::find();

        //$model = Lections::find()->all();
        //Yii::$app->userHelperClass->pre($model);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRec($id){
        //ML_TODO: actionRec ajax request 

        if (Yii::$app->request->isAjax)
        {
            $data = Yii::$app->request->queryParams;
            $Scenario = Scenarios::find()->where(['id' => $data['id']])->one();
            $arListDemo = json_decode($Scenario->demo_list_json);
            $demos = Demonstrations::find()->where(['in', 'id', $arListDemo])->all();
            echo json_encode(ArrayHelper::toArray($demos), JSON_UNESCAPED_UNICODE);
            exit();
        }
        else
        {
            $user_id = Yii::$app->user->id;
            $_GET['ScenariosSearch']['user_id'] = $user_id;

            $searchModel = new ScenariosSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('rec', [
                'model' => $this->findModel($id),
                'scenarioSearchModel' => $searchModel,
                'scenarioDataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionRecVideo($id, $idscn){
        if (Yii::$app->request->isAjax)
        {
            //ML_TODO: обработка ошибок записи в бд
            $dbConn = Yii::$app->db;
            $dbConn->createCommand()->delete('demonstration_time', 'lection_id = '.$id)->execute();
            $dbConn->createCommand()->delete('command', 'lection_id = '.$id)->execute();

            $demoList = json_decode(Yii::$app->request->post('jsonDemosList'), JSON_UNESCAPED_UNICODE);
            if(!empty($demoList))
            {
                foreach ($demoList as $n => $demoItem)
                {
                    $dbConn->createCommand()->insert(
                        'demonstration_time',
                        [
                            'demonstration_id' => $demoItem['demoID'],
                            'time' => $demoItem['demoTime'],
                            'lection_id' => $id
                        ]
                    )->execute();
                }
            }
            $commandList = json_decode(Yii::$app->request->post('jsonComandList'), JSON_UNESCAPED_UNICODE);
            if(!empty($commandList))
            {
                foreach ($commandList as $commandItem)
                {
                    $commandString = json_encode($commandItem, JSON_UNESCAPED_UNICODE);
                    $dbConn->createCommand()->insert(
                        'command',
                        [
                            'command' => $commandString,
                            'time' => $commandItem['time'],
                            'lection_id' => $id
                        ]
                    )->execute();

                }
            }

            $msg = ['result' => 'ok'];
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            exit();
        }
        else
        {
            $Scenario = Scenarios::find()->where(['id' => $idscn])->one();
            $video = Video::find()->where(['id'=>$this->findModel($id)->video_id])->one();
            $arListDemo = json_decode($Scenario->demo_list_json);
            $arDemos = Demonstrations::find()->where(['in', 'id', $arListDemo])->all();
            return $this->render('rec_video', [
                'id'=>$id,
                'idscn'=>$idscn,
                'arDemos'=>$arDemos,
                'lectionModel' => $this->findModel($id),
                'video' => $video
            ]);
        }
    }

    public function actionRecNovideo($id, $idscn){
        $Scenario = Scenarios::find()->where(['id' => $idscn])->one();
        $video = Video::find()->where(['id'=>$this->findModel($id)->video_id])->one();
        $arListDemo = json_decode($Scenario->demo_list_json);
        $arDemos = Demonstrations::find()->where(['in', 'id', $arListDemo])->all();
        return $this->render('rec_video', [
            'id'=>$id,
            'idscn'=>$idscn,
            'arDemos'=>$arDemos,
            'lectionModel' => $this->findModel($id),
            'video' => $video
        ]);
    }

    public function actionEdit($id)
    {

        return $this->render('edit', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionSync($id)
    {
        Yii::$app->userHelperClass->pre('actionSync');
        return $this->render('edit', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionExport($id)
    {
        Yii::$app->userHelperClass->pre('actionExport');
        return $this->render('edit', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Lections model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model['LECTION'] = $this->findRelationModel($id);
        $model['DEMO_ITEMS'] = $this->findDemonstrationsList($id);
        $model['COMMANDS_ITEMS'] = $this->findCommandsList($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionSlides()
    {
        $user_id = Yii::$app->user->identity->getId();

        $searchUserDemo = new DemonstrationsSearch();
        // if user = ADMIN then view all demo fore edit, alse user and all demo
        if (Yii::$app->user->identity->role == 20)
        {
            //SELECT * FROM  `demonstration` WHERE is_active = 1
            $userDemoCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `demonstration`',
                [':user_id' => $user_id])->queryScalar();
            $userDemoDataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM  `demonstration`',
                'params' => [':user_id' => $user_id],
                'totalCount' => $userDemoCount,
                'pagination' => [
                    'pageSize' => 1000,
                ],
                'sort' => [
                    'attributes' => [
                        'id',
                        'name',
                        'autor',
                        'type',
                    ],
                ],
            ]);
            $allDemosDataProvider = null;
        }
        else
        {
            $userDemoCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id',
                [':user_id' => $user_id])->queryScalar();

            $userDemoDataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id',
                'params' => [':user_id' => $user_id],
                'totalCount' => $userDemoCount,
                'pagination' => [
                    'pageSize' => 1000,
                ],
                'sort' => [
                    'attributes' => [
                        'id',
                        'name',
                        'autor',
                        'type',
                    ],
                ],
            ]);

            //SELECT * FROM  `demonstration` WHERE is_active = 1 AND is_visible = 1
            $allDemosCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `demonstration` WHERE is_active = 1 AND is_visible = 1 AND id NOT IN (SELECT id FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id)',
                [':user_id' => $user_id])->queryScalar();
            $allDemosDataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM  `demonstration` WHERE is_active = 1 AND is_visible = 1 AND id NOT IN (SELECT id FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id)',
                'params' => [':user_id' => $user_id],
                'totalCount' => $allDemosCount,
                'pagination' => [
                    'pageSize' => 1000,
                ],
                'sort' => [
                    'attributes' => [
                        'id',
                        'name',
                        'autor',
                        'type',
                    ],
                ],
            ]);
        }

        return $this->render('slides', [
            'user_id' => $user_id,
            'searchUserDemo' => $searchUserDemo,
            'userDemoDataProvider' => $userDemoDataProvider,
            'allDemosDataProvider' => $allDemosDataProvider,
        ]);
    }


    public function actionNewSlide()
    {
        if (Yii::$app->request->isPost)
        {
            $demo = Yii::$app->request->post('demo');
            $model = new Demonstrations();
             $demo['create_date'] = date("Y-m-d H:i:s");
             $demo['update_date'] = date("Y-m-d H:i:s");
            ($demo['is_active'] == 'on' ? $demo['is_active'] = '1' : $demo['is_active'] = '0');
            ($demo['is_visible'] == 'on' ? $demo['is_visible'] = '1' : $demo['is_visible'] = '0');

            if (!empty($_FILES['icon_src']['tmp_name']))
            {
                $uploadIconsPath = "repository/user/demonstrations/".$demo['type']."/icons/";
                if (is_dir($uploadIconsPath))
                {
                    //загрузка файла
                    $filename=basename($_FILES['icon_src']['name']);
                    $newFileNameIcon='icon_'.time().substr($filename, strpos($filename,'.'), strlen($filename)-1);

                    $uploadIconFile = $uploadIconsPath . $newFileNameIcon;
                    if (!move_uploaded_file($_FILES['icon_src']['tmp_name'], $uploadIconFile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadIconFile;
                    }
                } else {
                    mkdir($uploadIconsPath);
                    if (is_dir($uploadIconsPath))
                    {
                        //загрузка файла
                        $uploadIconFile = $uploadIconsPath . basename($_FILES['icon_src']['name']);
                        if (!move_uploaded_file($_FILES['icon_src']['tmp_name'], $uploadIconFile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadIconFile;
                        }
                    }
                }

                $demo['icon_src'] = "/".$uploadIconFile;
            }

            if (!empty($_FILES['content_src']['tmp_name']))
            {
                $uploadSrcPath = "repository/user/demonstrations/".$demo['type']."/contents/";
                if (is_dir($uploadSrcPath))
                {
                    //загрузка файла
                    $filename=basename($_FILES['content_src']['name']);
                    $newFileNameSrc='file_'.time().substr($filename, strpos($filename,'.'), strlen($filename)-1);

                    $uploadSrcFile = $uploadSrcPath . $newFileNameSrc;
                    if (!move_uploaded_file($_FILES['content_src']['tmp_name'], $uploadSrcFile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadSrcFile;
                    }
                } else {
                    mkdir($uploadSrcPath);
                    if (is_dir($uploadSrcPath))
                    {
                        $uploadSrcFile = $uploadSrcPath . basename($_FILES['content_src']['name']);
                        if (!move_uploaded_file($_FILES['content_src']['tmp_name'], $uploadSrcFile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadSrcFile;
                        }

                    }
                }
                $demo['src'] = "/".$uploadSrcFile;
            }

            $model->setAttributes($demo, false);
            if ($model->validate())
            {
                if ($model->save())
                {
                    return $this->goBack('');
                }
                else
                {
                    Yii::$app->userHelperClass->pre('save error');
                }
            }
            else
            {
                Yii::$app->userHelperClass->pre('validate error');
            }

        }
        else
        {
            return $this->render('new_slide');
        }
    }

    public function actionEditSlide($id)
    {
        if (Yii::$app->request->isPost)
        {
            $demo = Yii::$app->request->post('demo');

            $model = Demonstrations::findOne($id);
             $demo['update_date'] = date("Y-m-d H:i:s");
            ($demo['is_active'] == 'on' ? $demo['is_active'] = '1' : $demo['is_active'] = '0');
            ($demo['is_visible'] == 'on' ? $demo['is_visible'] = '1' : $demo['is_visible'] = '0');

            if (!empty($_FILES['icon_src']['tmp_name']))
            {
                $uploadIconsPath = "repository/user/demonstrations/".$demo['type']."/icons/";
                if (is_dir($uploadIconsPath))
                {
                    //загрузка файла
                    $filename=basename($_FILES['icon_src']['name']);
                    $newFileNameIcon='icon_'.time().substr($filename, strpos($filename,'.'), strlen($filename)-1);

                    $uploadIconFile = $uploadIconsPath . $newFileNameIcon;
                    if (!move_uploaded_file($_FILES['icon_src']['tmp_name'], $uploadIconFile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadIconFile;
                    }
                } else {
                    mkdir($uploadIconsPath);
                    if (is_dir($uploadIconsPath))
                    {
                        //загрузка файла
                        $uploadIconFile = $uploadIconsPath . basename($_FILES['icon_src']['name']);
                        if (!move_uploaded_file($_FILES['icon_src']['tmp_name'], $uploadIconFile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadIconFile;
                        }
                    }
                }
                unlink($_SERVER['DOCUMENT_ROOT'].$model->icon_src);
                $demo['icon_src'] = "/".$uploadIconFile;
            }

            if (!empty($_FILES['content_src']['tmp_name']))
            {
                $uploadSrcPath = "repository/user/demonstrations/".$demo['type']."/contents/";
                if (is_dir($uploadSrcPath))
                {
                    //загрузка файла
                    $filename=basename($_FILES['content_src']['name']);
                    $newFileNameSrc='file_'.time().substr($filename, strpos($filename,'.'), strlen($filename)-1);

                    $uploadSrcFile = $uploadSrcPath . $newFileNameSrc;
                    if (!move_uploaded_file($_FILES['content_src']['tmp_name'], $uploadSrcFile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadSrcFile;
                    }
                } else {
                    mkdir($uploadSrcPath);
                    if (is_dir($uploadSrcPath))
                    {
                        $uploadSrcFile = $uploadSrcPath . basename($_FILES['content_src']['name']);
                        if (!move_uploaded_file($_FILES['content_src']['tmp_name'], $uploadSrcFile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadSrcFile;
                        }

                    }
                }
                unlink($_SERVER['DOCUMENT_ROOT'].$model->src);
                $demo['src'] = "/".$uploadSrcFile;
            }

            $model->setAttributes($demo, false);
            if ($model->validate())
            {
                if ($model->save())
                {
                    return $this->goBack('');
                }
                else
                {
                    Yii::$app->userHelperClass->pre('save error');
                }
            }
            else
            {
                Yii::$app->userHelperClass->pre('validate error');
            }

        }
        else
        {
            if (($demoModel = Demonstrations::findOne($id)) !== null)
            {
                return $this->render('edit_slide', [
                    'id' => $id,
                    'demoModel' => $demoModel,
                ]);
            }
            else
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }

    public function actionScenario()
    {
        return $this->render('scenario');
    }

    public function actionEditScenario($id)
    {
        //ML_TODO: edit scenario
        if (Yii::$app->request->isPost)
        {
            Yii::$app->userHelperClass->pre('isPost');
            Yii::$app->userHelperClass->pre(Yii::$app->request->post);
        }
        else
        {
            return $this->render('edit_scenario',[
                'id' => $id
            ]);
        }

    }


    /**
     * Creates a new Lections model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNewLection()
    {
        //ML_TODO: actionNewLection
        if (Yii::$app->request->isPost)
        {
            $model = new Lections();
            $lection = Yii::$app->request->post('lection');

            $lection['create_date'] = date("Y-m-d H:i:s");
            $lection['update_date'] = date("Y-m-d H:i:s");
            $lection['is_active'] == 'on' ? $lection['is_active'] = '1' : $lection['is_active'] = '0';


            if ($_FILES['poster_src']['size'] > 0)
            {
                $poster_file = $_FILES['poster_src'];
                $uploadPosterPath = "repository/user/lections/";
                if (is_dir($uploadPosterPath))
                {
                    //загрузка файла
                    $filename = basename($poster_file['name']);
                    $newFileName = 'poster_' . time() . substr($filename, strpos($filename, '.'), strlen($filename) - 1);
                    $uploadPosterFile = $uploadPosterPath . $newFileName;
                    if (!move_uploaded_file($poster_file['tmp_name'], $uploadPosterFile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadPosterFile;
                    }

                }
                else
                {
                    mkdir($uploadPosterPath);
                    if (is_dir($uploadPosterPath))
                    {
                        //загрузка файла
                        $filename = basename($poster_file['name']);
                        $newFileName = 'poster_' . time() . substr($filename, strpos($filename, '.'), strlen($filename) - 1);
                        $uploadPosterFile = $uploadPosterPath . $newFileName;
                        if (!move_uploaded_file($poster_file['tmp_name'], $uploadPosterFile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadPosterFile;
                        }
                    }
                }
                $lection['poster'] = "/".$uploadPosterFile;
            }
            //Yii::$app->userHelperClass->pre($lection);
            //die();
            $model->setAttributes($lection, false);
            if ($model->validate())
            {
                if ($model->save())
                {
                    # return $this->goBack('');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else
                {
                    Yii::$app->userHelperClass->pre('save error');
                }
            }
            else
            {
                Yii::$app->userHelperClass->pre('validate error');
            }

        }
        else
        {
            $user_id = Yii::$app->user->identity->getId();

            //  Список видео доступных данному пользователю
            //  SELECT * FROM `video` WHERE is_active = 1 AND user_id = 2
            $userVideoCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `video` WHERE is_active = 1 AND user_id =:user_id',
                [':user_id' => $user_id])->queryScalar();

            $userVideoDataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM  `video` WHERE is_active = 1 AND user_id =:user_id',
                'params' => [':user_id' => $user_id],
                'totalCount' => $userVideoCount,
                'pagination' => [
                    'pageSize' => 1000,
                ],
                'sort' => [
                    'attributes' => [
                        'id',
                        'name',
                        'autor',
                        'create_date',
                        'update_date',
                    ],
                ],
            ]);
            $searchUserVideo = new VideoSearch();


            //  Список видео доступных всем: (или админу если пользователь админ role=20)
            if (Yii::$app->user->identity->role == 20)
            {
                //  SELECT * FROM  `video` WHERE is_active = 1
                $allVideoCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `video` WHERE is_active = 1 AND id NOT IN (SELECT id FROM  `video` WHERE is_active = 1 AND user_id =:user_id)',
                    [':user_id' => $user_id])->queryScalar();
                $allVideoDataProvider = new SqlDataProvider([
                    'sql' => 'SELECT * FROM  `video` WHERE is_active = 1 AND id NOT IN (SELECT id FROM  `video` WHERE is_active = 1 AND user_id =:user_id)',
                    'params' => [':user_id' => $user_id],
                    'totalCount' => $allVideoCount,
                    'pagination' => [
                        'pageSize' => 1000,
                    ],
                    'sort' => [
                        'attributes' => [
                            'id',
                            'name',
                            'autor',
                            'create_date',
                            'update_date',
                        ],
                    ],
                ]);
            }
            else
            {
                //  SELECT * FROM  `video` WHERE is_active = 1 AND is_visible = 1 AND id NOT IN (SELECT id FROM  `video` WHERE is_active = 1 AND user_id = 2)
                $allVideoCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `video` WHERE is_active = 1 AND is_visible = 1 AND id NOT IN (SELECT id FROM  `video` WHERE is_active = 1 AND user_id =:user_id)',
                    [':user_id' => $user_id])->queryScalar();
                $allVideoDataProvider = new SqlDataProvider([
                    'sql' => 'SELECT * FROM  `video` WHERE is_active = 1 AND is_visible = 1 AND id NOT IN (SELECT id FROM  `video` WHERE is_active = 1 AND user_id =:user_id)',
                    'params' => [':user_id' => $user_id],
                    'totalCount' => $allVideoCount,
                    'pagination' => [
                        'pageSize' => 1000,
                    ],
                    'sort' => [
                        'attributes' => [
                            'id',
                            'name',
                            'autor',
                            'create_date',
                            'update_date',
                        ],
                    ],
                ]);
            }


            return $this->render('create_lection', [
                'userVideoDataProvider' => $userVideoDataProvider,
                'searchUserVideo' => $searchUserVideo,
                'allVideoDataProvider' => $allVideoDataProvider,
            ]);
        }
        # video_id
        # $video = new Video();
        //$video = Video::find()->where(['is_active' => '1', 'is_visible' => '1'])->orderBy('id')->all();

        #Yii::$app->userHelperClass->pre($video);

        //return $this->render('create_lection');

        /*
        $model = new Lections();
        //$demo['created_date'] = date("Y-m-d H:i:s");
        //$demo['update_date'] = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create_lection', [
                'model' => $model,
            ]);
        }
        */
    }

    /**
     * Updates an existing Lections model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$demo['update_date'] = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lections model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id)
    {
        //ML_TODO: Удаление
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSlideDelete($id)
    {
        //ML_TODO: Удаление
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lections model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lections the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lections::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRelationModel($id)
    {
        /*
        SELECT
            l.id, l.name, l.poster, v.name, v.file_src
        FROM
            lections AS l
        LEFT JOIN
            video AS v
        ON
            v.lection_id=l.id
        WHERE
            l.id=1
        */
        $model = Lections::find()
            ->select('* ,video.autor AS video_autor ,lections.autor AS lection_autor ,lections.id AS lection_id, video.id AS video_id, lections.name AS lection_name, video.name AS video_name')
            ->from('lections')
            ->leftjoin('video', 'video.id = lections.video_id')
            ->andWhere('lections.id = '.$id)
            ->asArray()
            ->one();


        if (($model) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function findDemonstrationsList($id)
    {
        /*
        SELECT
            demonstration_time.id, demonstration_time.lection_id AS lection_id, demonstration.autor,
            demonstration.name, demonstration.icon_src, demonstration.src, demonstration_time.time
        FROM
            demonstration
        LEFT JOIN
            demonstration_time ON demonstration_time.demonstration_id = demonstration.id
        WHERE
            demonstration_time.lection_id =1
        ORDER BY
            `demonstration_time`.`time` +0 ASC
        */
        $demonstrations_model = Lections::find()
            ->select('demonstration_time.id, demonstration_time.lection_id AS lection_id, demonstration.autor, demonstration.name, demonstration.type, demonstration.icon_src, demonstration.src, demonstration_time.time')
            ->from('demonstration')
            ->leftJoin('demonstration_time', 'demonstration_time.demonstration_id = demonstration.id')
            ->andWhere('demonstration_time.lection_id = '.$id)
            ->addOrderBy(['`demonstration_time`.`time`'.'+0' => SORT_ASC])
            ->asArray()
            ->all();


        if (($demonstrations_model) !== null) {
            return $demonstrations_model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function findCommandsList($id)
    {
        $commands_model = Yii::$app->db->createCommand(
            'SELECT * FROM command WHERE lection_id = '.$id.' ORDER BY time ASC'
        )->queryAll();

        if (($commands_model) !== null) {
            return $commands_model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}