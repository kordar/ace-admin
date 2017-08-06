<?php

use yii\db\Migration;

class m170716_094337_news_main extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%news_main}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('标题'),
            'auth' => $this->string()->comment('作者'),
            'from' => $this->string()->comment('来源'),
            'thumbnail' => $this->string()->comment('图片地址'),
            'desc' => $this->text()->comment('描述'),
            'content' => $this->text()->comment('内容'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'publish_date' => $this->integer(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%news_main}}');

        return false;
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
