<?php

use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    // <div class='is-animate style'><div class="text-warning">2</div><div class="text-info">3</div><div class="text-info">3</div><div class="text-danger">G</div><div class="text-danger">a</div><div class="text-success">m</div><div>e</div><div class="text-danger">s</div></div>
    'brandLabel' => '233Games',
    'options' => [
        'class' => 'navbar-inverse',
    ],
]);



echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        ['label' => '游戏咨询', 'url' => ['/news/index']],
        ['label' => '游戏大厅', 'url' => ['/games/index']]
    ],
]);




if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => '<span class="glyphicon glyphicon-user"></span> 注册', 'url' => ['/site/signup'], 'encode' => false];
    $menuItems[] = ['label' => '<span class="glyphicon glyphicon-user"></span> 登录', 'url' => ['/site/login'], 'encode' => false];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            '登出 (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

$menuItems[] = ['label' => Html::tag('span', '', ['class'=>'glyphicon glyphicon-headphones']) . ' 进入论坛', 'url' => ['#'], 'encode' => false];



echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right', 'id' => 'navbar-right'],
    'items' => $menuItems,
]);

NavBar::end();


$js = <<<JS

    var box = $('.navbar-brand').text(),
    rs = $('.navbar-brand'),
    f = [
      'arial','verdana','monospace',
      'consolas','impact','helveltica'
    ],
    c = [
      '1ABC9C','3498DB','E67E22',
      'E74C3C','2ECC71','E74C3C','D35400'
    ];
var out = '';
for (var i = 0; i < box.length; i++) {
  // Random array fonts
  var r = f[Math.floor(Math.random() * f.length)],
      // Random array colors
      sh = c[Math.floor(Math.random() * c.length)],
      st = 'color:#'+sh;
  out += '<span style="'+st+'">'+box[i]+'</span>';
}  
rs.html(out);

JS;

$this->registerJs($js);

?>