<?php
namespace common\widgets\advisory;

use yii\bootstrap\Widget;

class NewsList extends Widget
{
    public $newsList;
    public $pages;

    public function run()
    {
        return $this->render('news-list', ['list'=>$this->newsList, 'pages'=>$this->pages]);
    }

}