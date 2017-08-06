<?php
$this->title = '开服列表';
?>

<div class="site-index">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <?= $list;?>
        </div>
    </div>
</div>


<?php

$js = <<<JS

$('.tab01').addClass('table table-bordered');
$('.tab01').find('th,td').addClass('text-center');

$('.a04_sty a').text('进入官网');
$('.a04_sty a').addClass('btn btn-success');


JS;


$this->registerJS($js);

?>


