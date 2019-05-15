<?php

use yii\db\Migration;

/**
 * Class m190515_201556_create_rooms_records
 */
class m190515_201556_create_rooms_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            insert into `rooms` (`questions_pack_id`, `name`)
            values (1, 'room1'),
                   (2, 'room2')");

        $this->execute("
            insert into `questions_packs_questions` (`questions_pack_id`, `question_id`)
            values ('1', '1'),
                   ('1', '2'),
                   ('1', '3'),
                   ('1', '4')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190515_201556_create_rooms_records cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190515_201556_create_rooms_records cannot be reverted.\n";

        return false;
    }
    */
}
