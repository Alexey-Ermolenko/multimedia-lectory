<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;


class UserSearch extends User
{
    public $id;
    public $role;
    public $username;
    public $email;
    public $status;

    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['id', 'status'], 'integer'],
            [['username', 'email'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id])->andFilterWhere(['role'=> $this->role]);
        $query->andFilterWhere(['like', 'username', $this->username])->andFilterWhere(['like', 'email', $this->email]);

        $query->andFilterWhere(['status' => $this->status]);

        return $dataProvider;
    }

}