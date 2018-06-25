<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_profile`.
 */
class m180122_202643_create_user_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'profile_pic' => $this->integer(),
            'personal_details' => $this->text(),
            'interests' => $this->text(),
            'gallery' => $this->integer(),
            'contact' => "VARCHAR(11)",
        ]);

        $this->addForeignKey('fk_profile_user', 'user_profile', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_profile');
        $this->dropForeignKey('fk_profile_user', 'user_profile');
    }
}
