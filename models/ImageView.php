<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ImageView extends Model
{
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['verifyCode'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => Yii::$app->reCaptcha->secret]
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verify Code',
        ];
    }    
    
    public function getRandomImage() {
        $url = 'http://api.giphy.com/v1/gifs/random?api_key=' . Yii::$app->params['giphyApiKey'] . '&tag=american';
        
        $content = file_get_contents($url);
        $content = json_decode($content, TRUE);
        
        return $content;
    }
}
