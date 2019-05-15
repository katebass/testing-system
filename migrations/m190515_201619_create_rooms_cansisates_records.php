<?php

use yii\db\Migration;

/**
 * Class m190515_201619_create_rooms_cansisates_records
 */
class m190515_201619_create_rooms_cansisates_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            insert into `rooms_candidates` (`room_id`, `candidate_id`, `points`, `conclusion`)
            values ('1', '4', '0', 'no....'),
                   ('1', '5', '1', 'yes!')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190515_201619_create_rooms_cansisates_records cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190515_201619_create_rooms_cansisates_records cannot be reverted.\n";

        return false;
    }
    */
}
