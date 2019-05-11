<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%results}}`.
 */
class m190511_145638_create_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('results');
        $this->createTable('results', [
            'id' => $this->primaryKey(),
            'room_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'points' => $this->float(),
            'conclusion' => $this->text()
        ]);

        $this->addForeignKey(
            'results_room_fk',
            'results',
            'room_id',
            'rooms',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'results_user_fk',
            'results',
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
        $this->dropTable('results');
    }
}
