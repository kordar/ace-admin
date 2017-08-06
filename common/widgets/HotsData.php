<?php
namespace common\widgets;


class HotsData extends \yii\bootstrap\Widget
{

    public $datas = [];

    public function run()
    {
        return $this->render('hots-data', ['datas'=>$this->datas]);
    }
}