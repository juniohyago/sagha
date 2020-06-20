<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aula_curso}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%aula}}`
 * - `{{%curso}}`
 */
class m200617_225457_create_junction_table_for_aula_and_curso_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aula_curso}}', [
            'aula_id' => $this->integer(),
            'curso_id' => $this->integer(),
            'PRIMARY KEY(aula_id, curso_id)',
        ]);

        // creates index for column `aula_id`
        $this->createIndex(
            '{{%idx-aula_curso-aula_id}}',
            '{{%aula_curso}}',
            'aula_id'
        );

        // add foreign key for table `{{%aula}}`
        $this->addForeignKey(
            '{{%fk-aula_curso-aula_id}}',
            '{{%aula_curso}}',
            'aula_id',
            '{{%aula}}',
            'id',
            'CASCADE'
        );

        // creates index for column `curso_id`
        $this->createIndex(
            '{{%idx-aula_curso-curso_id}}',
            '{{%aula_curso}}',
            'curso_id'
        );

        // add foreign key for table `{{%curso}}`
        $this->addForeignKey(
            '{{%fk-aula_curso-curso_id}}',
            '{{%aula_curso}}',
            'curso_id',
            '{{%curso}}',
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
            '{{%fk-aula_curso-aula_id}}',
            '{{%aula_curso}}'
        );

        // drops index for column `aula_id`
        $this->dropIndex(
            '{{%idx-aula_curso-aula_id}}',
            '{{%aula_curso}}'
        );

        // drops foreign key for table `{{%curso}}`
        $this->dropForeignKey(
            '{{%fk-aula_curso-curso_id}}',
            '{{%aula_curso}}'
        );

        // drops index for column `curso_id`
        $this->dropIndex(
            '{{%idx-aula_curso-curso_id}}',
            '{{%aula_curso}}'
        );

        $this->dropTable('{{%aula_curso}}');
    }
}
