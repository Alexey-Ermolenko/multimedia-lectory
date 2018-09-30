<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "demonstration".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $is_active
 * @property integer $is_visible
 * @property string $type
 * @property string $autor
 * @property string $name
 * @property string $icon_src
 * @property string $src
 * @property string $create_date
 * @property string $update_date
 */
class Demonstrations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'demonstration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'is_active', 'is_visible', 'type', 'autor', 'name', 'icon_src', 'src', 'create_date', 'update_date'], 'required'],
            [['user_id', 'is_active', 'is_visible', 'type', 'autor', 'name', 'icon_src', 'src', 'create_date', 'update_date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User_id',
            'is_active' => 'Is_active',
            'is_visible' => 'Is_visible',
            'type' => 'Type',
            'autor' => 'Autor',
            'name' => 'Name',
            'icon_src' => 'Icon Src',
            'src' => 'Src',
            'create_date' => 'Create date',
            'update_date' => 'Update date',
        ];
    }

    public function Search($params)
    {
        $query = Demonstrations::find();

        $dataProvider = new SqlDataProvider([
            'query' => $query,
        ]);


        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
