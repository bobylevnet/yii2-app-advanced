<?php

use yii\db\Migration;

class m170420_060046_add_column_files extends Migration
{
    public function up()
    {
                $this->addColumn('dataexcel', 'file', $this->text());
    }

    public function down()
    {


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
