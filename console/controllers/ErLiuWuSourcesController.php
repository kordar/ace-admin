<?php
/**
 * Created by PhpStorm.
 * User: kordar
 * Date: 17-7-15
 * Time: 上午8:14
 */
namespace console\controllers;

use yii\console\Controller;
use Yii;

class ErLiuWuSourcesController extends Controller
{
    protected function url_manager()
    {
        //$type = [1=>'角色扮演', 2=>'战争策略', 3=>'模拟经营', 4=>'儿童养成', 5=>'休闲竞技', 6=>'枪战射击'];
        $type = [6=>'枪战射击'];


//        $theme = [1=>'三国', 2=>'西游', 3=>'仙侠', 4=>'武侠', 5=>'奇幻', 6=>'星战', 7=>'动漫', 8=>'军事', 9=>'体育', 10=>'传奇', 11=>'盗墓', 12=>'IP改编'];
        $theme = [1=>'三国', 2=>'西游', 3=>'仙侠', 4=>'武侠', 5=>'奇幻', 6=>'星战', 7=>'动漫', 8=>'军事', 9=>'体育', 10=>'传奇', 11=>'盗墓', 12=>'IP改编'];


//        $games = [1=>'九宫格', 2=>'塔防', 3=>'射击', 4=>'经营', 5=>'推图', 6=>'音乐'];
        $games = [1=>'九宫格', 2=>'塔防', 3=>'射击', 4=>'经营', 5=>'推图', 6=>'音乐'];


        $show = [1=>'横版', 2=>'Q萌', 3=>'3D', 4=>'2D'];


        $period = [1=>'2017', 2=>'2016', 3=>'2015', 4=>'2014', 5=>'2013', 6=>'2012', 7=>'2011', 8=>'其他'];
        $method = [1=>'回合', 2=>'即时', 3=>'其他'];

        $url = [];
        $i = 0;

        foreach ($type as $_typekey => $_type) {

            foreach ($theme as $_themekey => $_theme) {

                foreach ($games as $_gameskey => $_games) {

                    foreach ($show as $_showkey => $_show) {

                        foreach ($period as $_periodkey => $_period) {

                            foreach ($method as $_methodkey => $_method) {

                                $j = 1;
                                while ($j <= 1) {
                                    $url[$i]['url'] = "http://zhaoht.265g.com/index.php?c=zyx_ajax&m=zhao_search_new&leixing=leixing_{$_typekey},&ticai=ticai_{$_themekey},&wanfa=wanfa_{$_gameskey},&huamian=huamian_{$_showkey},&niandai={$_period},&zhandou={$_methodkey},&order=wxh&xsfs=intro_list&page={$j}&k=&_=1500096464357";
                                    //$url[$i]['key'] = [$_typekey => $_type, $_themekey => $_theme, $_statuskey => $_status];
                                    $url[$i]['key'] = [$_type, $_theme, $_games, $_show, $_period, $_method];
                                    $i++;
                                    $j++;
                                }

                            }

                        }

                    }

                }

            }


        }

        return $url;
    }

    public function actionGetContents()
    {
        $urls = $this->url_manager();

        $datas = [];
        $i = 0;

        foreach ($urls as $_key => $url) {
            //初始化
            $ch = curl_init();
            //设置选项，包括URL
            curl_setopt($ch, CURLOPT_URL, $url['url']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            //执行并获取HTML文档内容
            $output = curl_exec($ch);
            //释放curl句柄
            curl_close($ch);
            //打印获得的数据
            $output = mb_convert_encoding($output,"utf-8",  "gbk");

            preg_match_all("/<li>.*?<\/i>(.*?)<\/a> <\/li>/ism", $output, $title);

            preg_match_all("/<li>.*?<i>(.*?)<\/i>.*?<\/li>/ism", $output, $level);

            preg_match_all("/<li>.*?<img src=\"(.*?)\" width=.*?<\/li>/ism", $output, $imgs);

            preg_match_all("/<li>.*?<a href=\"(.*?)\" target=.*?<\/li>/ism", $output, $a);

            foreach ($title[1] as $k => $t) {
                $title = trim(strip_tags($t));
                $href = trim($a[1][$k]);
                $lev = trim($level[1][$k]);
                $img = trim($imgs[1][$k]);
                $datas[$i] = [$title, $img, $lev, $href, $url['key'][0], $url['key'][1], $url['key'][2], $url['key'][3], $url['key'][4], $url['key'][5], time()];
                $i++;
            }

        }

        \Yii::$app->db->createCommand()->batchInsert('{{%265g_game_library}}', ['title', 'img_src', 'level', 'a_href', 'type', 'theme', 'games', 'show', 'period', 'method', 'crawl_at'], $datas)->execute();

        echo "success\n";

    }

    public function actionSetDes()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'a_href'])
            ->from('{{%265g_game_library}}')
            ->where('`desc` is null')
            ->all();


        foreach ($rows as $row) {

            //初始化
            $ch = curl_init();
            //设置选项，包括URL
            curl_setopt($ch, CURLOPT_URL, $row['a_href'] . '/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            //执行并获取HTML文档内容
            $output = curl_exec($ch);
            //释放curl句柄
            curl_close($ch);
            //打印获得的数据
            $output = mb_convert_encoding($output,"utf-8",  "gbk");

            preg_match_all("/<dd class=\"zdb_cent\">(.*?)<\/dd>/ism", $output, $match);

            if (isset($match[1][0])) {
                $sql= "update {{%265g_game_library}} set `desc`='{$match[1][0]}' where `id`={$row['id']}";
                \Yii::$app->db->createCommand($sql)->query();
            }

        }

    }


    public function actionSetImg()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'img_src'])
            ->from('{{%265g_game_library}}')
            ->all();

        foreach ($rows as $row) {
            $this->GetImage($row['img_src'], $row['id']);
        }
    }

    protected function GetImage($url, $id = "")
    {

        if ($url == "") {

            return false;

        }

        $ext = strrchr ( $url, "." );

        if ($ext != ".gif" && $ext != ".jpg" && $ext != ".png") {

            return false;

        }

        $filename = $id . $ext;

        //文件 保存路径

        ob_start ();

        readfile ( 'http://' . $url );

        $img = ob_get_contents ();

        ob_end_clean ();

        $size = strlen ( $img );

        //文件大小

        $dir = dirname(dirname(__DIR__)) . '/frontend/web/images/xiaopi/' . $id . '/';
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $fp2 = @fopen ( $dir . $filename, "a" );

        fwrite ( $fp2, $img );

        fclose ( $fp2 );

        return $filename;

    }

}