<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rooms}}`.
 */
class m190511_145233_create_rooms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('rooms_candidates_room_fk', 'rooms_candidates');
        $this->dropForeignKey('candidates_answers_rooms_fk', 'candidates_answers');
        $this->dropTable('rooms');
        $this->createTable('rooms', [
            'id' => $this->primaryKey(),
            'questions_pack_id' => $this->integer()->notNull(),
            'name' => $this->string(256)->notNull()->unique(),
            'start_datetime' => $this->dateTime(),
            'end_datetime' => $this->dateTime(),
            'state' => $this->string()->defaultValue('New'),
            'points' => $this->float()->defaultValue('1')
        ]);

        $this->addForeignKey(
            'rooms_questions_pack_fk',
            'rooms',
            'questions_pack_id',
            'questions_packs',
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
        $this->dropTable('rooms');
    }
}
