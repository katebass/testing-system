<?php

use yii\db\Migration;

/**
 * Class m190515_201528_create_questions_pack_records
 */
class m190515_201528_create_questions_pack_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->execute("
            insert into `questions` (`user_id`, `name`, `question`, `points`)
            values ('1', 'php1', 'what is php?', '1'),
                   ('1', 'php2', 'what is php2?', '2'),
                   ('1', 'php3', 'what is php3?', '3'),
                   ('1', 'php4', 'what is php4?', '2'),
                   ('1', 'php5', 'what is php5?', '3')");

        $this->execute("
            insert into `tags` (`name`)
            values ('tag1'), ('tag2'), ('tag3'), ('tag4'), ('tag5')");

        $this->execute("
            insert into `questions_packs` (`user_id`, `name`, `description`)
            values ('1', 'php_basic', 'description1'),
                   ('2', 'php_advanced', 'description2')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190515_201528_create_questions_pack_records cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190515_201528_create_questions_pack_records cannot be reverted.\n";

        return false;
    }
    */
}
