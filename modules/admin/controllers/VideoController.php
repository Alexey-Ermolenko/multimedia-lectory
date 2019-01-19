<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Video;
use app\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        //  $searchModel = new VideoSearch();
        //  $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $user_id = Yii::$app->user->identity->getId();
        $searchModel = new VideoSearch();

        // if user = ADMIN then view all video for edit, alse user and all video
        if (Yii::$app->user->identity->role == 20)
        {
            //SELECT * FROM  `demonstration` WHERE is_active = 1
            $userVideosCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `video`',
                [':user_id' => $user_id])->queryScalar();
            $userVideoDataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM  `video`',

                'totalCount' => $userVideosCount,
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
            $allVideosDataProvider = null;
        }
        else
        {
            $userVideosCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `video` WHERE is_active = 1 AND user_id =:user_id',
                [':user_id' => $user_id])->queryScalar();

            $userVideoDataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM  `video` WHERE is_active = 1 AND user_id =:user_id',
                'params' => [':user_id' => $user_id],
                'totalCount' => $userVideosCount,
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

            //SELECT * FROM  `video` WHERE is_active = 1 AND is_visible = 1
            $allVideosCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `video` WHERE is_active = 1 AND is_visible = 1 AND id NOT IN (SELECT id FROM  `video` WHERE is_active = 1 AND user_id =:user_id)',
                [':user_id' => $user_id])->queryScalar();
            $allVideoDataProvider = new SqlDataProvider([
                'sql' => 'SELECT * FROM  `video` WHERE is_active = 1 AND is_visible = 1 AND id NOT IN (SELECT id FROM  `video` WHERE is_active = 1 AND user_id =:user_id)',
                'params' => [':user_id' => $user_id],
                'totalCount' => $allVideosCount,
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

        return $this->render('index', [
            'user_id' => $user_id,
            'searchModel' => $searchModel,
            'userVideoDataProvider' => $userVideoDataProvider,
            'allVideoDataProvider' => $allVideoDataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //ML_TODO: Video Create

        if (Yii::$app->request->isPost)
        {
            $model = new Video();
            $video = Yii::$app->request->post('Video');
            //Yii::$app->userHelperClass->pre($video);

            $video['create_date'] = date("Y-m-d H:i:s");
            $video['update_date'] = date("Y-m-d H:i:s");

            ($video['is_active'] == 'on' ? $video['is_active'] = '1' : $video['is_active'] = '0');
            ($video['is_visible'] == 'on' ? $video['is_visible'] = '1' : $video['is_visible'] = '0');

            if (!empty($_FILES['file_src']))
            {
                $video_file = $_FILES['file_src'];

                $uploadVideoPath = "repository/user/video/";
                if (is_dir($uploadVideoPath))
                {
                    //загрузка файла
                    $filename = basename($video_file['name']);
                    $newFileName = 'video_' . time() . substr($filename, strpos($filename, '.'), strlen($filename) - 1);
                    $uploadVideoFile = $uploadVideoPath . $newFileName;
                    if (!move_uploaded_file($video_file['tmp_name'], $uploadVideoFile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadVideoFile;
                    }

                }
                else
                {
                    mkdir($uploadVideoPath);
                    if (is_dir($uploadVideoPath))
                    {
                        //загрузка файла
                        $filename = basename($video_file['name']);
                        $newFileName = 'video_' . time() . substr($filename, strpos($filename, '.'), strlen($filename) - 1);
                        $uploadVideoFile = $uploadVideoPath . $newFileName;
                        if (!move_uploaded_file($video_file['tmp_name'], $uploadVideoFile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadVideoFile;
                        }
                    }
                }
                $video['file_src'] = "/".$uploadVideoFile;
            }

            $model->setAttributes($video, false);
            if ($model->validate())
            {
                if ($model->save())
                {
                    //return $this->goBack('');
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
            return $this->render('create');
        }

    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //ML_TODO: update
        if (Yii::$app->request->isPost)
        {
            $model = Video::findOne($id);
            $video = Yii::$app->request->post('Video');
            //Yii::$app->userHelperClass->pre($video);


            $video['update_date'] = date("Y-m-d H:i:s");

            ($video['is_active'] == 'on' ? $video['is_active'] = '1' : $video['is_active'] = '0');
            ($video['is_visible'] == 'on' ? $video['is_visible'] = '1' : $video['is_visible'] = '0');

            if ($_FILES['file_src']['size'] > 0)
            {
                $video_file = $_FILES['file_src'];

                $uploadVideoPath = "repository/user/video/";
                if (is_dir($uploadVideoPath))
                {
                    //загрузка файла
                    $filename = basename($video_file['name']);
                    $newFileName = 'video_' . time() . substr($filename, strpos($filename, '.'), strlen($filename) - 1);
                    $uploadVideoFile = $uploadVideoPath . $newFileName;
                    if (!move_uploaded_file($video_file['tmp_name'], $uploadVideoFile))
                    {
                        echo "Файл не был успешно загружен 404<br>";
                        echo $uploadVideoFile;
                    }

                }
                else
                {
                    mkdir($uploadVideoPath);
                    if (is_dir($uploadVideoPath))
                    {
                        //загрузка файла
                        $filename = basename($video_file['name']);
                        $newFileName = 'video_' . time() . substr($filename, strpos($filename, '.'), strlen($filename) - 1);
                        $uploadVideoFile = $uploadVideoPath . $newFileName;
                        if (!move_uploaded_file($video_file['tmp_name'], $uploadVideoFile))
                        {
                            echo "Файл не был успешно загружен 404<br>";
                            echo $uploadVideoFile;
                        }
                    }
                }
                //$model->file_src
                unlink($_SERVER['DOCUMENT_ROOT'].$model->file_src);
                $video['file_src'] = "/".$uploadVideoFile;
            }
            else
            {
                $video['file_src'] = $model->file_src;
            }

            $model->setAttributes($video, false);
            if ($model->validate())
            {
                if ($model->save())
                {
                    //return $this->goBack('');
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
            if (($model = Video::findOne($id)) !== null)
            {
                return $this->render('update', [
                    'id' => $id,
                    'model' => $model,
                ]);
            }
            else
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        /*
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        */
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //ML_TODO: Удаление
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
