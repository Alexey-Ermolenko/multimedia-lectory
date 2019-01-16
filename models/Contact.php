<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            [['name', 'email'], 'string', 'max' => 70],
            [['message'], 'string', 'max' => 768],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function sendEmail($view, $subject, $params = [])
    {/*
        $content = "<p>Email: " . $this->email . "</p>";
        $content .= "<p>Name: " . $this->name . "</p>";
        $content .= "<p>Date: " . date("Y-m-d H:i:s") . "</p>";
        $content .= "<p>Message: " . $this->message . "</p>";
        if ($this->validate()) {
            Yii::$app->mailer->compose("@app/mail/layouts/html", ["content" => $content])
                //->setTo($email)
                ->setTo('a.o.ermolenko@gmail.ru')
                ->setFrom([\Yii::$app->params['supportEmail'] => $this->name])
                ->setTextBody($this->message)
                ->send();

            return true;
        }
        return false;*/


        /*
        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo('a.o.ermolenko@gmail.ru')
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
            ->send();


        return true;
         */

        #Yii::$app->userHelperClass->pre('777');
        #    die();

        \Yii::$app->mailer->getView()->params['userName'] = "username";

        $result = \Yii::$app->mailer->compose([
            'html' => $view . '-html',
            'text' => $view . '-text',
        ], $params)->setTo(["a.o.ermolenko@gmail.com" => "username"])
            ->setSubject($subject)
            ->send();

        // Reset layout params
        \Yii::$app->mailer->getView()->params['userName'] = null;

        return $result;
    }
}
