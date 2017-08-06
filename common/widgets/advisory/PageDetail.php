<?php
namespace common\widgets\advisory;

use yii\bootstrap\Widget;

class PageDetail extends Widget
{
    public $pageInfo;

    public function run()
    {
        return $this->render('page-detail', ['page'=>$this->pageInfo]);
    }

}