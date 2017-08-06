<?php


/* @var $this yii\web\View */

$this->title = '娱乐大厅';
?>
<div class="site-index">

    <div class="row">

            <div class="col-sm-9">
                <?= \common\widgets\Thumbnail::widget(['items'=>$games]);?>
            </div>

            <div class="col-sm-3">
                <?= \common\widgets\HotsData::widget(['datas'=>array_slice($games, 0, 20)]);?>
            </div>

    </div>

</div>

<?php

$url = \yii\helpers\Url::toRoute('incr-views');

$js = <<<JS
    $('a[data-business]').click(function(){
        var id = $(this).attr('data-business');
        $.post("$url", {'id':id}, function(data){});
    });
JS;

$this->registerJs($js);

?>
