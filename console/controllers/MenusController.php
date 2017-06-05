<?php
namespace console\controllers;

use yii\console\Controller;

class MenusController extends Controller
{

    public function autoMenus()
    {
        $path = dirname(__DIR__);
        echo $path;die;
        $obj = new \kordar\ace\tree\AutoMenusByFile();

        // 实例化
        foreach ($obj as $item) {
            echo $item . PHP_EOL;
        }
    }

}