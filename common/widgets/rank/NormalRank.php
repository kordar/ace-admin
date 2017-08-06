<?php
namespace common\widgets\rank;

use yii\bootstrap\Widget;

class NormalRank extends Widget
{
    public $rankList;

    public function run()
    {
        return $this->render('normal-rank', ['list'=>$this->rankList]);
    }

}