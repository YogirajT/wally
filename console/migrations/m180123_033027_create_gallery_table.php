<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gallery`.
 */
class m180123_033027_create_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'pictures_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('gallery');
    }
}
