<?php
namespace common\widgets\site;

class Banner extends \yii\bootstrap\Widget
{
    public function run()
    {
        return $this->render('banner');
    }
}