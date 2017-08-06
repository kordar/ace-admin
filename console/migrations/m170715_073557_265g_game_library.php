<?php

use yii\db\Migration;

class m170715_073557_265g_game_library extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%265g_game_library}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('游戏标题'),
            'img_src' => $this->string()->notNull()->comment('游戏图片地址'),
            'level' => $this->smallInteger()->comment('评级'),
            'a_href' => $this->string()->comment('链接地址'),
            'desc' => $this->text()->comment('描述'),
            'type' => $this->string()->notNull()->comment('游戏类型'),
            'theme' => $this->string()->notNull()->comment('游戏题材'),
            'games' => $this->string()->notNull()->comment('游戏玩法'),
            'show' => $this->string()->notNull()->comment('游戏画面'),
            'period' => $this->string()->notNull()->comment('游戏年代'),
            'method' => $this->string()->notNull()->comment('战斗方式'),
            'crawl_at' => $this->integer()->notNull()->comment('抓取时间'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%265g_game_library}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
