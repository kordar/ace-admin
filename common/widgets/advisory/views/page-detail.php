
<h1><?= $page['title']?></h1>

<p>
    <i>作者: <?= $page['auth']?></i>
     /
    <i>来源: <?= $page['from']?></i>
    /
    <i>发布时间: <?= date('Y-m-d', $page['publish_at'])?></i>
</p>

<?= $page['content']?>