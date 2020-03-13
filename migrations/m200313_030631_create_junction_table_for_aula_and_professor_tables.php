<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aula_professor}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%aula}}`
 * - `{{%professor}}`
 */
class m200313_030631_create_junction_table_for_aula_and_professor_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aula_professor}}', [
            'aula_id' => $this->integer(),
            'professor_id' => $this->integer(),
            'PRIMARY KEY(aula_id, professor_id)',
        ]);

        // creates index for column `aula_id`
        $this->createIndex(
            '{{%idx-aula_professor-aula_id}}',
            '{{%aula_professor}}',
            'aula_id'
        );

        // add foreign key for table `{{%aula}}`
        $this->addForeignKey(
            '{{%fk-aula_professor-aula_id}}',
            '{{%aula_professor}}',
            'aula_id',
            '{{%aula}}',
            'id',
            'CASCADE'
        );

        // creates index for column `professor_id`
        $this->createIndex(
            '{{%idx-aula_professor-professor_id}}',
            '{{%aula_professor}}',
            'professor_id'
        );

        // add foreign key for table `{{%professor}}`
        $this->addForeignKey(
            '{{%fk-aula_professor-professor_id}}',
            '{{%aula_professor}}',
            'professor_id',
            '{{%professor}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%aula}}`
        $this->dropForeignKey(
            '{{%fk-aula_professor-aula_id}}',
            '{{%aula_professor}}'
        );

        // drops index for column `aula_id`
        $this->dropIndex(
            '{{%idx-aula_professor-aula_id}}',
            '{{%aula_professor}}'
        );

        // drops foreign key for table `{{%professor}}`
        $this->dropForeignKey(
            '{{%fk-aula_professor-professor_id}}',
            '{{%aula_professor}}'
        );

        // drops index for column `professor_id`
        $this->dropIndex(
            '{{%idx-aula_professor-professor_id}}',
            '{{%aula_professor}}'
        );

        $this->dropTable('{{%aula_professor}}');
    }
}
