<?php

use yii\db\Migration;

/**
 * Class m190515_192402_add_fake_records_to_tables
 */
class m190515_192402_add_fake_records_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            insert into `user` (`username`, `password`, `email`)
            values ('manager1', '".password_hash('manager1', PASSWORD_DEFAULT)."', 'manager1@gmail.com'),
                   ('manager2', '".password_hash('manager2', PASSWORD_DEFAULT)."', 'manager2@gmail.com'),
                   ('admin', '".password_hash('admin', PASSWORD_DEFAULT)."', 'admin@gmail.com'),
                   ('candidate1', '".password_hash('candidate1', PASSWORD_DEFAULT)."', 'candidate1@gmail.com'),
                   ('candidate2', '".password_hash('candidate2', PASSWORD_DEFAULT)."', 'candidate2@gmail.com'),
                   ('candidate3', '".password_hash('candidate3', PASSWORD_DEFAULT)."', 'candidate3@gmail.com')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190515_192402_add_fake_records_to_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190515_192402_add_fake_records_to_tables cannot be reverted.\n";

        return false;
    }
    */
}
