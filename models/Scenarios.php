<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scenarios".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $autor
 * @property string $description
 * @property string $demo_list_json
 * @property string $create_date
 * @property string $update_date
 */
class Scenarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scenarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'autor', 'description', 'demo_list_json', 'create_date', 'update_date'], 'required'],
            [['user_id'], 'integer'],
            [['description', 'demo_list_json'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['name', 'autor'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'autor' => 'Autor',
            'description' => 'Description',
            'demo_list_json' => 'Demo List Json',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}
