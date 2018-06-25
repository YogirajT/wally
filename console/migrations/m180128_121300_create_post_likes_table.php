<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_likes`.
 */
class m180128_121300_create_post_likes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post_likes', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->addForeignKey('fk_post_likes', 'post_likes', 'post_id', 'posts', 'id');
        $this->addForeignKey('fk_user_likes', 'post_likes', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post_likes');
        $this->dropForeignKey('fk_post_likes', 'post_likes');
        $this->dropForeignKey('fk_user_likes', 'post_likes');
    }
}
