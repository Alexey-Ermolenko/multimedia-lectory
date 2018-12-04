<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Demonstrations;

/**
 * DemonstrationsSearch represents the model behind the search form about `app\models\Demonstrations`.
 */
class DemonstrationsSearch extends Demonstrations
{
    /**
     * @inheritdoc
     */
    public $video;

    public function rules()
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['name', 'description', 'keywords', 'content', 'task_group', 'autor', 'create_date', 'poster', 'update_date'], 'safe'],
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
        $query = Demonstrations::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        if (Yii::$app->user->identity->role == 20)
        {
            $user_id ='';
            $is_visible = '';
        }
        else
        {
            $user_id = Yii::$app->user->id;
            $is_visible = '';
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $user_id,
            'is_active' => $this->is_active,
            'is_visible' => $is_visible,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date
        ]);

        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
