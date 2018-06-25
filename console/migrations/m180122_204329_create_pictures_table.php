<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pictures`.
 */
class m180122_204329_create_pictures_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pictures', [
            'id' => $this->primaryKey(),
            'alt' => $this->string(),
            'media_type' => $this->integer(),
            'file_name' => $this->string(),
            'file_type' => $this->string(),
            'file_size' => 'INT NULL',
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL',
        ]);

        $this->addForeignKey('fk_user_profile_pics', 'user_profile', 'profile_pic', 'pictures', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pictures');
        $this->dropForeignKey('fk_user_profile_pics', 'user_profile');
    }
}
