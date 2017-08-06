<?php
namespace common\libs\advisory;

use kordar\ace\web\Parser;
use Yii;

class Page
{

    static public function pageDetail($id)
    {
        $cashKey = 'common:libs:advisory:page:detail:' . $id;
        if (Yii::$app->cache->exists($cashKey)) {
            return Yii::$app->cache->get($cashKey);
        } else {
            $data = self::newsQuery()->where(['id'=>$id])->one();
            $markdown = new Parser();
            $data['content'] = $markdown->makeHtml($data['content']);
            Yii::$app->cache->set($cashKey, $data, 10);
            return $data;
        }
    }

    static public function newsQuery()
    {
        return (new \yii\db\Query())->from('{{%news_main}}');
    }

}

