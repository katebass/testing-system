<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions_pack}}`.
 */
class m190511_080917_create_questions_pack_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('questions_packs_questions_qp_fk', 'questions_packs_questions');
        $this->dropForeignKey('rooms_questions_pack_fk', 'rooms');
        $this->dropTable('questions_packs');
        $this->createTable('questions_packs', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(191)->notNull(),
            'description' => $this->text(),
        ]);

        $this->addForeignKey(
            'questions_pack_user_fk',
            'questions_packs',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('questions_pack');
    }
}
