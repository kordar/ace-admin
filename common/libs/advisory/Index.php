<?php
namespace common\libs\advisory;

use Yii;

class Index
{
    static public function newsList($page, $pagesize)
    {
        $cacheKey = 'common:libs:advisory:index:news:list';
        if (Yii::$app->cache->exists($cacheKey)) {
            return array_slice(Yii::$app->cache->get($cacheKey), ($page -1) * $pagesize, $pagesize);
        }
        return [];
    }

    static public function newsListCounts()
    {
        $cacheKey = 'common:libs:advisory:index:news:list:counts';
        return Yii::$app->cache->get($cacheKey);
    }

    static public function refreshNewsList()
    {
        $list = self::newsQuery()->select(['id','title','desc','thumbnail','auth','from','publish_at'])->where('publish_at IS NOT NULL')->orderBy('publish_at DESC, id DESC')->all();
        Yii::$app->cache->set('common:libs:advisory:index:news:list', $list);
        Yii::$app->cache->set('common:libs:advisory:index:news:list:counts', count($list));
    }

    static public function newsQuery()
    {
        return (new \yii\db\Query())->from('{{%news_main}}');
    }
}

