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

class XiaoPiSourcesController extends Controller
{
    protected function url_manager()
    {
        //$type = array(1=>'即时', 2=>'动作', 3=>'策略', 4=>'回合', 5=>'休闲', );
        $type = array(6=>'卡牌');
        $theme = array(20=>'三国', 21=>'西游', 22=>'仙侠', 23=>'武侠', 24=>'魔幻', 25=>'历史', 26=>'战争', 27=>'体育', 28=>'其他');
        $status = array(40=>'预告',41=>'封测',42=>'内测',43=>'公测',44=>'运营');

        $url = [];
        $i = 0;

        foreach ($type as $_typekey => $_type) {
            foreach ($theme as $_themekey => $_theme) {
                foreach ($status as $_statuskey => $_status) {
                    $j = 1;
                    while ($j <= 8) {
                        $url[$i]['url'] = "http://sj.xiaopi.com/list-13--{$_typekey}-{$_themekey}-{$_statuskey}-{$j}.html";
                        //$url[$i]['key'] = [$_typekey => $_type, $_themekey => $_theme, $_statuskey => $_status];
                        $url[$i]['key'] = [$_type, $_theme, $_status];
                        $i++;
                        $j++;
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
            preg_match_all("/<div class=\"info\">[\s]*<h5>(.*?)<\/h5>/ism", $output, $title);
            preg_match_all("/<div class=\"text\">(.*?)<\/div>/ism", $output, $text);
            preg_match_all("/<div class=\"pic\">.*?<img src=\"\/\/(.*?)\" width=.*?><\/div>/ism", $output, $imgs);

            foreach ($title[1] as $k => $t) {
                $title = trim(strip_tags($t));
                $des = trim(strip_tags($text[1][$k]));
                $img = trim($imgs[1][$k]);
                $datas[$i] = [$title, $img, $des, $url['key'][0], $url['key'][1], $url['key'][2], time()];
                $i++;
            }
        }

        \Yii::$app->db->createCommand()->batchInsert('{{%xiaopi_game_library}}', ['title', 'img_src', 'desc', 'type', 'theme', 'status', 'crawl_at'], $datas)->execute();

        echo "success\n";

    }

    public function actionSetImg()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'img_src'])
            ->from('{{%xiaopi_game_library}}')
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