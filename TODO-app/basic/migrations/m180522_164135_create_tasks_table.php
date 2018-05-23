<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m180522_164135_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull()->defaultValue(''),
            'date' => $this->datetime()->defaultValue(NULL),
            'task_status' => $this->integer()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }
}
