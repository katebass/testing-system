<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions_tags}}`.
 */
class m190511_080713_create_questions_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('questions_tags');
        $this->createTable('questions_tags', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'questions_tags_questions_fk',
            'questions_tags',
            'question_id',
            'questions',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'questions_tags_tags_fk',
            'questions_tags',
            'tag_id',
            'tags',
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
        $this->dropTable('questions_tags');
    }
}
