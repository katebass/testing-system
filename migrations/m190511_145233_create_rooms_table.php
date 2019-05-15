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
        $this->dropTable('rooms');
        $this->createTable('rooms', [
            'id' => $this->primaryKey(),
            //'user_id' => $this->integer()->notNull(),
            'questions_pack_id' => $this->integer()->notNull(),
            'name' => $this->string(256)->notNull(),
            'start_datetime' => $this->dateTime()->notNull(),
            'end_datetime' => $this->dateTime(),
        ]);

//        $this->addForeignKey(
//            'rooms_user_fk',
//            'rooms',
//            'user_id',
//            'user',
//            'id',
//            'CASCADE',
//            'CASCADE'
//        );

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
