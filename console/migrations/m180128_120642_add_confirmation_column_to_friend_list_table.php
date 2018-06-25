<?php

use yii\db\Migration;

/**
 * Handles adding confirmation to table `friend_list`.
 */
class m180128_120642_add_confirmation_column_to_friend_list_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('friend_list', 'confirmation', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('friend_list', 'confirmation');
    }
}
