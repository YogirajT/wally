<?php

use yii\db\Migration;

/**
 * Class m180121_192429_add_column_to_user_table
 */
class m180121_192429_add_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
    
        $this->addColumn('user', 'role', 'VARCHAR(255) AFTER username');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        $this->dropColumn('user','role');
        
    }

}
