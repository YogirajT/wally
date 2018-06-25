<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friend_list`.
 */
class m180122_235418_create_friend_list_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('friend_list', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'friend_id' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_at' => $this->integer(),
        ]);

        $this->addForeignKey('fk_user_friends', 'friend_list', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_friend_friends', 'friend_list', 'friend_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('friend_list');
        $this->dropForeignKey('fk_user_friends', 'friend_list');
        $this->dropForeignKey('fk_friend_friends', 'friend_list');
    }
}
