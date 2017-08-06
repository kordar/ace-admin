<div class="row">

    <?php foreach($items as $item):?>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail" data-toggle="tooltip" data-placement="right" title="<?= $item['des']?>">
                <a target="_blank" class="thumbnail-inner" href="<?= $item['href']?>" data-business=<?= $item['id']?>>
                    <img src="<?= $item['img']?>" alt="<?= $item['title']?>" class="img-responsive center-block">
                </a>
                <div class="caption">
                    <a target="_blank" href="<?= $item['href']?>" data-business=<?= $item['id']?>>
                        <?= $item['title']?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach;?>

</div>

<?php

$js = <<<JS
    
    var minHeigh = 0;
    $('.thumbnail').find('img').each(function(){
        if (minHeigh == 0) {
            minHeigh = $(this).height();
        }
        if (minHeigh > $(this).height()) {
            minHeigh = $(this).height();
        }
    }).css('height', minHeigh);

JS;

$this->registerJs($js);

?>