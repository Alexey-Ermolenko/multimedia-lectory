<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;

use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "lections".
 *
 * @property integer $id
 * @property integer $user_id
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
            [['name', 'description', 'keywords', 'content', 'task_group', 'autor', 'is_active','poster'], 'required'],
            [['description', 'keywords', 'content', 'task_group', 'autor'], 'string'],
            [['is_active', 'user_id', 'video_id'], 'integer'],
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


}
