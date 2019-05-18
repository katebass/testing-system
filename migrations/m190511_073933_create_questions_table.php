<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions}}`.
 */
class m190511_073933_create_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('questions_answers_fk', 'answers');
        $this->dropForeignKey('questions_tags_questions_fk', 'questions_tags');
        $this->dropForeignKey('questions_packs_questions_q_fk', 'questions_packs_questions');
        $this->dropForeignKey('candidates_answers_questions_fk', 'candidates_answers');
        $this->dropTable('questions');
        $this->createTable('questions', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10),
            'name' => $this->string()->notNull()->unique(),
            'question' => $this->text()->notNull(),
            'points' => $this->float()->notNull()->defaultValue(1),
        ]);

        $this->addForeignKey(
            'questions_users_fk',
            'questions',
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
        $this->dropTable('questions');
    }
}
