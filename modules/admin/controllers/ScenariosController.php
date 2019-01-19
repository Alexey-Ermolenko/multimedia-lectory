<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Scenarios;
use app\models\ScenariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use app\models\Lections;
use app\models\LectionsSearch;


use app\models\Demonstrations;
use app\models\DemonstrationsSearch;

use yii\data\SqlDataProvider;

use yii\data\Sort;

use yii\data\Pagination;
use app\models\Country;

use yii\filters\AccessControl;

/**
 * ScenariosController implements the CRUD actions for Scenarios model.
 */
class ScenariosController extends Controller
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Scenarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        //  ML_TODO: user_id
        //  $user_id = Yii::$app->user->id;
        //  $_GET['ScenariosSearch']['user_id'] = $user_id;


        $searchModel = new ScenariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Scenarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $arListDemo = json_decode($model['demo_list_json']);
        $demos = Demonstrations::find()->where(['in', 'id', $arListDemo])->all();


        $model->demo_list_json = $demos;

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Scenarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scenarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionNewScenario()
    {
        //ML_TODO: actionNewScenario
        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('data');
            $scenariosModel = new Scenarios();

            $data['demo_list_json'] =  json_encode($data['demos']);

            $data['create_date'] = date("Y-m-d H:i:s");
            $data['update_date'] = date("Y-m-d H:i:s");
            unset($data['demos']);


            $scenariosModel->setAttributes($data, false);


            if ($scenariosModel->validate())
            {
                if ($scenariosModel->save())
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
            $user_id = Yii::$app->user->identity->getId();
            #$demonstrations = new Demonstrations();
            #$searchModel = new DemonstrationsSearch();

            // Список демонстраций доступных данному пользователю
            // SELECT * FROM  `demonstration` WHERE is_active = 1 AND user_id = 2

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
            $searchUserDemo = new DemonstrationsSearch();

            //Список демонстраций доступных всем: (или админу если пользователь админ role=20)
            if (Yii::$app->user->identity->role == \app\models\User::ROLE_ADMIN)
            {
                //SELECT * FROM  `demonstration` WHERE is_active = 1
                $allDemosCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `demonstration` WHERE is_active = 1 AND id NOT IN (SELECT id FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id)',
                    [':user_id' => $user_id])->queryScalar();
                $allDemosDataProvider = new SqlDataProvider([
                    'sql' => 'SELECT * FROM  `demonstration` WHERE is_active = 1 AND id NOT IN (SELECT id FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id)',
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
            else
            {
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

            return $this->render('new_scenario', [
                'userDemoDataProvider' => $userDemoDataProvider,
                'searchUserDemo' => $searchUserDemo,

                'allDemosDataProvider' => $allDemosDataProvider,
            ]);
        }

    }

    /**
     * Updates an existing Scenarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost)
        {
            $array = Yii::$app->request->post();
            $array['data']['demo_list_json'] =  json_encode($array['data']['demos']);
            $array['data']['update_date'] = date("Y-m-d H:i:s");
            unset($array['data']['demos']);
            $model->setAttributes($array['data'], false);
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
           #$demonstrations = new Demonstrations();
           #$searchModel = new DemonstrationsSearch();

           // Список демонстраций доступных данному пользователю
           // SELECT * FROM  `demonstration` WHERE is_active = 1 AND user_id = 2

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
           $searchUserDemo = new DemonstrationsSearch();

           //Список демонстраций доступных всем: (или админу если пользователь админ role=20)
           if (Yii::$app->user->identity->role == \app\models\User::ROLE_ADMIN)
           {
               //SELECT * FROM  `demonstration` WHERE is_active = 1
               $allDemosCount = Yii::$app->db->createCommand('SELECT count(*) FROM  `demonstration` WHERE is_active = 1 AND id NOT IN (SELECT id FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id)',
                   [':user_id' => $user_id])->queryScalar();
               $allDemosDataProvider = new SqlDataProvider([
                   'sql' => 'SELECT * FROM  `demonstration` WHERE is_active = 1 AND id NOT IN (SELECT id FROM  `demonstration` WHERE is_active = 1 AND user_id =:user_id)',
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
           else
           {
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

           return $this->render('update', [
               'userDemoDataProvider' => $userDemoDataProvider,
               'searchUserDemo' => $searchUserDemo,
               'model' => $model,
               'allDemosDataProvider' => $allDemosDataProvider,
           ]);
       }
   }

   /**
    * Deletes an existing Scenarios model.
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
     * Finds the Scenarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Scenarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Scenarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
