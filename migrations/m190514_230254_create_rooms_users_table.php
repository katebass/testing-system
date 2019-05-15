<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rooms_users}}`.
 */
class m190514_230254_create_rooms_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('rooms_candidates');
        $this->createTable('rooms_candidates', [
            'id' => $this->primaryKey(),
            'room_id' => $this->integer()->notNull(),
            'candidate_id' => $this->integer()->notNull(),
            'points' => $this->float()->defaultValue(0),
            'conclusion' => $this->text()
        ]);

        $this->addForeignKey(
            'rooms_candidates_room_fk',
            'rooms_candidates',
            'room_id',
            'rooms',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'rooms_candidates_user_fk',
            'rooms_candidates',
            'candidate_id',
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
        $this->dropTable('{{%rooms_users}}');
    }
}
