<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answers}}`.
 */
class m190511_075524_create_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('candidates_answers_answers_fk', 'candidates_answers');
        $this->dropTable('answers');
        $this->createTable('answers', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'answer' => $this->string()->notNull(),
            'is_correct' => $this->boolean()->notNull(),
        ]);

        $this->addForeignKey(
            'questions_answers_fk',
            'answers',
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
        $this->dropTable('answers');
    }
}
