<?php

use yii\db\Migration;

class m170405_053927_excel extends Migration
{
    public function up()
    {
    	$this->createTable('{{%organization}}', [
    			'id' => $this->primaryKey(),
    			'created_at' => $this->integer()->notNull(),
    			'updated_at' => $this->integer()->notNull(),
    			'name' => $this->string()->notNull(),
    			'status' => $this->smallInteger()->notNull()->defaultValue(0),
    	], $tableOptions);
    }

    public function down()
    {
        echo "m170405_053927_excel cannot be reverted.\n";

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
