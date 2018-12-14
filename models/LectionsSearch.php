<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lections;

/**
 * LectionsSearch represents the model behind the search form about `app\models\Lections`.
 */
class LectionsSearch extends Lections
{
    /**
     * @inheritdoc
     */
    public $video;

    public function rules()
    {
        return [
            [['id', 'is_active', 'user_id', 'category_id', 'video_id'], 'integer'],
            [['name', 'description', 'keywords', 'content', 'task_group', 'autor', 'created_date', 'update_date','poster'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Lections::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        if (Yii::$app->user->identity->role != 20)
        {
           $user_id = Yii::$app->user->id;
        } else
        {
            $user_id ='';
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $user_id,
            'category_id' => $this->category_id,
            'video_id' => $this->video_id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'task_group', $this->task_group])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'poster', $this->poster])
            ->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
