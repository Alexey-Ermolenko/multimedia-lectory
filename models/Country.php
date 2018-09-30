<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.12.2017
 * Time: 17:53
 */

namespace app\models;


use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
    function getCountry() {
        // получаем все строки из таблицы "country" и сортируем их по "name"
        $countries = Country::find()->orderBy('name')->all();
        return $countries;
    }
}