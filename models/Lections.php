<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;

use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;

use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "lections".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $video_id
 * @property string $name
 * @property string $description
 * @property string $keywords
 * @property string $content
 * @property string $task_group
 * @property string $autor
 * @property integer $is_active
 * @property string $created_date
 * @property string $update_date
 * @property string $poster
 */
class Lections extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lections';
    }

    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' => 'video_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'is_active'], 'required'],
            [['description', 'keywords', 'content', 'task_group', 'autor'], 'string'],
            [['is_active', 'user_id', 'video_id', 'category_id'], 'integer'],
            [['created_date', 'update_date'], 'safe'],
            [['name', 'poster'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'video_id' => 'Video',
            'name' => 'Name',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'content' => 'Content',
            'task_group' => 'Task Group',
            'autor' => 'Autor',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
            'poster' => 'Poster',
        ];
    }

    public function search($params)
    {
        $query = Lections::find();

        $dataProvider = new SqlDataProvider([
            'query' => $query,
        ]);


        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    /**
     * Запись в бд кол-во просмотров лекции
     * @param integer $id
     * @return bool
     */
    public static function setViewCount($id)
    {
//Yii::$app->userHelperClass->pre($session->get('lection_post_view'));

        $session = Yii::$app->session;
        // Если в сессии отсутствуют данные,
        // создаём, увеличиваем счетчик, и записываем в бд
        if (!isset($session['lection_post_view']))
        {
            $session->set('lection_post_view', [$id]);


            Yii::$app->db->createCommand('
                    UPDATE lections SET view_count = view_count + 1 WHERE id = '.$id
            )->execute();

            // Если в сессии уже есть данные то проверяем засчитывался ли данный пост
            // если нет то увеличиваем счетчик, записываем в бд и сохраняем в сессию просмотр этого поста
        }
        else
        {
            if (!ArrayHelper::isIn($id, $session['lection_post_view']))
            {
                $array = $session['lection_post_view'];
                array_push($array, $id);
                $session->remove('lection_post_view');
                $session->set('lection_post_view', $array);

                Yii::$app->db->createCommand('
                    UPDATE lections SET view_count = view_count + 1 WHERE id = '.$id
                )->execute();
            }
        }
        return true;
    }

}
