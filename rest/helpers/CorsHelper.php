<?php
namespace app\rest\helpers;

use Yii;

class CorsHelper
{
    public static function setAllowCors()
    {
        $headers = Yii::$app->response->headers;

        $headers->set('Access-Control-Allow-Origin', '*');
        $headers->set('Access-Control-Allow-Methods', 'POST,GET,PUT,DELETE');
        $headers->set('Access-Control-Allow-Headers', 'Authorization, Content-Type, Cache-Control');
        $headers->set('Access-Control-Allow-Credentials', 'true');

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("HTTP/1.1 200 OK");
            Yii::$app->end();
        }
    }
}