<?php
namespace console\controllers;

use yii\console\Controller;

class MenusController extends Controller
{

    public function actionAuto()
    {
        $path = dirname(dirname(__DIR__));
        $obj = new \kordar\ace\tree\AutoMenusByFile($path);

        print_r(\Yii::$app->controller->module->id);die;

        echo \Yii::$app->controller->id;
        echo PHP_EOL;
        echo \Yii::$app->controller->action->id;
        echo PHP_EOL;
        echo $this->context->module->id;
        die;

        // 实例化
        foreach ($obj as $item) {
            echo $item . PHP_EOL;
        }

    }

}