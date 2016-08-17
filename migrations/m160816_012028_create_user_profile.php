<?php

use yii\db\Schema;
use yii\db\Migration;

class m160816_012028_create_user_profile extends Migration
{
    public function up()
    {
		$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_profile}}', [
            'cedula' => $this->primaryKey(),
            'nombre' => $this->string(50)->notNull(),
            'apellido' => $this->string(50)->notNull(),
        ], $tableOptions);
    }
    }

    public function down()
    {
        $this->dropTable('{{%user_profile}}');
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
