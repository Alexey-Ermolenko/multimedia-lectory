<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $lection_id
 * @property string $name
 * @property string $autor
 * @property string $file_src
 * @property string $create_date
 * @property string $update_date
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }


    public function getLections()
    {
        return $this->hasMany(Lections::className(), ['video_id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'autor', 'file_src'], 'required'],
            [['user_id'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['name', 'autor', 'file_src'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'autor' => Yii::t('app', 'Autor'),
            'file_src' => Yii::t('app', 'File Src'),
            'create_date' => Yii::t('app', 'Create Date'),
            'update_date' => Yii::t('app', 'Update Date'),
        ];
    }
}
