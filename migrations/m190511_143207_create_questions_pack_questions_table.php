<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions_pack_questions}}`.
 */
class m190511_143207_create_questions_pack_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('questions_packs_questions');
        $this->createTable('questions_packs_questions', [
            'id' => $this->primaryKey(),
            'questions_pack_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'questions_packs_questions_qp_fk',
            'questions_packs_questions',
            'questions_pack_id',
            'questions_packs',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'questions_packs_questions_q_fk',
            'questions_packs_questions',
            'question_id',
            'questions',
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
        $this->dropTable('questions_pack_questions');
    }
}
