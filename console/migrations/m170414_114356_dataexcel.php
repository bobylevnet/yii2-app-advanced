<?php

use yii\db\Migration;

class m170414_114356_dataexcel extends Migration
{
    public function up()
    {
            $this->createTable('dataexcel', ['id' => $this->text(),
            'column1' => $this->text(),
            'column2' => $this->text(),
            'column3' => $this->text(),
            'column4' => $this->text(),
            'column5' => $this->text(),
            'column6' => $this->text(),
            'column7' => $this->text(),
            'column8' => $this->text(),
            'column9' => $this->text(),
            'column10' => $this->text(),
            'column11' => $this->text(),
            'column12' => $this->text(),
            'column13' => $this->text(),
            'column14' => $this->text(),
            'column15' => $this->text(),
            'column16' => $this->text(),
            'column17' => $this->text(),
            'column18' => $this->text(),
            'column19' => $this->text(),
            'column20' => $this->text(),
            'column21' => $this->text(),
            'column22' => $this->text(),
            'column23' => $this->text(),
            'column24' => $this->text(),]);
            
             return true; 
    }

    public function down()
    {
        echo "m170414_114356_dataexcel cannot be reverted.\n";

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
