<div class="list-group">

    <span href="#" class="list-group-item text-center">
        <b class="list-group-item-heading text-info ">
             热门推荐
        </b>
    </span>

    <?php foreach($datas as $data):?>
        <a data-business=<?= $data['id']?> target="_blank" href="<?= $data['href']?>" class="list-group-item">
            <h5 class="list-group-item-heading">
                <?= $data['title']?> <small class="text-danger">(<?= $data['num']?>人体验)
                <?php
                    $i = $data['star'];
                    while ($i > 0) {
                        echo '<span class="glyphicon glyphicon-star-empty text-danger text-danger"></span>';
                        $i--;
                    }
                ?>
                </small>
            </h5>
            <p class="list-group-item-text">
            </p>
        </a>
    <?php endforeach;?>

</div>