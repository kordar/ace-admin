<?php

use yii\db\Migration;

class m170729_081927_parts_assign extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parts_assign}}', [
            'item_id' => $this->integer()->notNull(),
            'part_id' => $this->integer()->notNull(),
            'area_id' => $this->integer()->notNull(),
            'PRIMARY KEY (item_id, part_id, area_id)'
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%parts_assign}}');

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
