<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php $this->beginBlock('carousel')?>

    <div class="row">
        <div class="col-sm-12">



            <?php echo \yii\bootstrap\Carousel::widget([
                'items' => [
                    // 只有图片的格式
//                    '<img src="images/carousel1.jpg"/>',
//                    '<img src="images/carousel2.jpg"/>',

                    // 与上面的效果一致
//                    ['content' => '<img src="http://www.yii-china.com/statics/images/b_1.jpg"/>'],
//
//                    // 包含图片和字幕的格式
                    [
                        'content' => '<img src="images/carousel1.jpg"/>',
                        'caption' => '',
                        //'options' => [...],       //配置对应的样式
                    ],
                    [
                        'content' => '<img src="images/carousel2.jpg"/>',
                        'caption' => '',
                        //'options' => [...],       //配置对应的样式
                    ],
                ],
                'options' => ['class'=>'my-carousel carousel slide'],
                'showIndicators' => false,
                'controls' => ['', '']
            ]);
            ?>





        </div>
    </div>

    <?php $this->endBlock(); ?>


    <div class="body-content">

        <div class="row">

            <div class="col-lg-7">
                <?= \common\widgets\site\NewsHeader::widget();?>
            </div>

            <div class="col-lg-5 no-padding-left">
                <?= \common\widgets\site\Rank::widget();?>
            </div>

        </div>



        <div class="row">
            <div class="col-sm-12">
                <?= \common\widgets\site\Billing::widget(['alt'=>'ad']);?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <?= \common\widgets\site\Search::widget();?>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <?= \common\widgets\site\Billing::widget(['alt'=>'ad2']);?>
            </div>
        </div>



        <div class="row">

            <div class="col-sm-12">
                <?= \common\widgets\site\CompetitiveGames::widget() ?>
            </div>

        </div>


        <div class="row">

            <div class="col-sm-12">
                <?= \common\widgets\site\WebGames::widget() ?>
            </div>

        </div>


        </div>

    </div>

</div>


