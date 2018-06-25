<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m180122_211303_create_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'post_id' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->addForeignKey('fk_post_comments', 'comments', 'post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_comments', 'comments', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comments');
        $this->dropForeignKey('fk_post_comments', 'comments');
        $this->dropForeignKey('fk_user_comments', 'comments');
    }
}
