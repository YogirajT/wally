<?php

use yii\db\Migration;

class m160819_080253_insert_record_for_superadmin extends Migration
{
    public function up()
    {
		$time = time();
		$this->insert('user',array(
			'username'=>'superadmin',
			'role' => '1',
			'auth_key'=>'Chkmx-mYmIp6WYvTjIxEcXSPxawEMbH8',
			'password_hash'=>'$2y$13$eA0JQAI5cQz5L1J1dGh8Xes.R10A6dcfrpC/9VuuH03NbumLf7xgK',
			'email' => 'admin@gmail.com',
			'created_at' => $time,
			'updated_at' => $time,
		));

    }

    public function down()
    {
       
    }


}
