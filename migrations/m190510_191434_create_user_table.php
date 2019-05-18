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
        $this->dropForeignKey('questions_users_fk', 'questions');
        $this->dropForeignKey('questions_pack_user_fk', 'questions_packs');
        $this->dropForeignKey('rooms_candidates_user_fk', 'rooms_candidates');
        $this->dropForeignKey('candidates_answers_users_fk', 'candidates_answers');
        $this->dropTable('user');

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            //'role' => $this->string(255)->notNull()->defaultValue('manager'),
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
