<?php

use yii\db\Migration;

class m170708_055826_games extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%business}}', [
            'name' => $this->string()->comment('商家名称'),
            'link' => $this->string()->comment('url'),
            'des' => $this->text()->comment('描述'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'PRIMARY KEY ([[name]])',
        ], $tableOptions);

        $this->createTable('{{%spread}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('游戏标题'),
            'cate' => $this->smallInteger()->notNull()->defaultValue(0)->comment('分类,1广告2注册'),
            'spread_link' => $this->string()->notNull()->comment('推广链接'),
            'business' => $this->string()->comment('商家'),
            'images_url' => $this->string()->comment('图片ID'),
            'des' => $this->text()->comment('描述'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'FOREIGN KEY ([[business]]) REFERENCES {{%business}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',

        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%spread}}');
        $this->dropTable('{{%business}}');
    }
}
