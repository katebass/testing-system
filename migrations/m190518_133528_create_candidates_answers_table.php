<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%candidates_answers}}`.
 */
class m190518_133528_create_candidates_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('candidates_answers');
        $this->createTable('candidates_answers', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10),
            'question_id' => $this->integer(10),
            'room_id' => $this->integer(10),
            'answer_id' => $this->integer(10),
        ]);

        $this->addForeignKey(
            'candidates_answers_users_fk',
            'candidates_answers',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'candidates_answers_questions_fk',
            'candidates_answers',
            'question_id',
            'questions',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'candidates_answers_rooms_fk',
            'candidates_answers',
            'room_id',
            'rooms',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'candidates_answers_answers_fk',
            'candidates_answers',
            'answer_id',
            'answers',
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
        $this->dropTable('candidates_answers');
    }
}
