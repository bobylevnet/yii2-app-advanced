<?php

use yii\db\Migration;

class m170420_060425_files extends Migration
{
    public function up()
    {
     $this->createTable('files', [
         'id' => $this->primaryKey(),
         'name' => $this->text(),
         'comment'=> $this->text()
            ]);
            
             return true; 
    }

    public function down()
    {
        echo "m170420_060425_files cannot be reverted.\n";

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
