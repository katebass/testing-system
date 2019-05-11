<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190510_191434_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->execute('CREATE TABLE IF NOT EXISTS `user` (
//                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
//                            `username` varchar(255) NOT NULL,
//                            `password` varchar(255) NOT NULL,
//                            `role` varchar(255) NOT NULL DEFAULT \'manager\',
//                            PRIMARY KEY (`id`),
//                            UNIQUE KEY `username` (`username`)
//                            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;');

        $this->dropForeignKey('questions_users_fk', 'questions');
        $this->dropForeignKey('questions_pack_user_fk', 'questions_packs');
        $this->dropForeignKey('rooms_user_fk', 'rooms');
        $this->dropForeignKey('results_user_fk', 'results');
        $this->dropTable('user');
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'role' => $this->string(255)->notNull()->defaultValue('manager'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
