<?php

namespace app\controllers;

use Yii;
use app\models\Lections;
use app\models\LectionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use \yii\db\Query;

/**
 * LectionsController implements the CRUD actions for Lections model.
 */
class LectionsController extends Controller
{
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
     * Lists all Lections models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = Yii::$app->request->queryParams;

        #Yii::$app->userHelperClass->pre($params);

        /*
        SELECT
        *
        FROM
        lections
        WHERE
        created_date LIKE '%2018-09%'
        */

        $searchModel = new LectionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination([
            'pageSize' => 10
        ]);

        // /index?LectionsSearch[category_id]=1
        // /index?LectionsSearch[created_date]=2018-04

        $categories = Yii::$app->db->createCommand('
            SELECT id, name, (SELECT count(*) FROM lections WHERE category_id = c.id) as count FROM category c HAVING count > 0
        ')->queryAll();


        $dates = Yii::$app->db->createCommand('
            SELECT DISTINCT DATE_FORMAT(created_date, \'%Y-%m\') created_date FROM lections
        ')->queryAll();

        $popular_lections = Yii::$app->db->createCommand('
            SELECT id, name, DATE_FORMAT(created_date, \'%d/%m/%Y\') created_date, view_count 
            FROM lections 
            ORDER BY view_count  DESC 
            LIMIT 5
        ')->queryAll();


        if(Yii::$app->request->queryParams['LectionsSearch']['category_id'] != null)
        {
            $category = Yii::$app->db->createCommand('
                SELECT * FROM category WHERE id = '.Yii::$app->request->queryParams['LectionsSearch']['category_id']
            )->queryOne();

        }


        return $this->render('index', [
            'categories' => $categories,
            'dates' => $dates,
            'category' => $category,
            'popular_lections' => $popular_lections,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lections model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Lections::setViewCount($id);

        return $this->render('view', [
            'model' => $this->findRelationModel($id),
            'demonstrations_model' => $this->findDemonstrationsList($id),
        ]);
    }

    /**
     * Creates a new Lections model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lections();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
    public function actionDelete($id)
    {
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
            ->select('demonstration_time.id, demonstration_time.lection_id AS lection_id, demonstration.autor, demonstration.name, demonstration.icon_src, demonstration.src, demonstration_time.time')
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
}
