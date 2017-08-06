<?php

use yii\db\Migration;

class m170729_054336_parts extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parts}}', [
            'part_id' => $this->integer()->notNull(),
            'desc' => $this->string()->notNull()->comment('描述'),
            'parent_id' => $this->integer()->defaultValue(0)->comment('父元素ID'),
            'PRIMARY KEY (part_id, parent_id)'
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%parts}}');

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
