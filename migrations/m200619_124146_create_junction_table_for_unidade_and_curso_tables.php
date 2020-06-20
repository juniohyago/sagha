<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%unidade_curso}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%unidade}}`
 * - `{{%curso}}`
 */
class m200619_124146_create_junction_table_for_unidade_and_curso_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%unidade_curso}}', [
            'unidade_id' => $this->integer(),
            'curso_id' => $this->integer(),
            'PRIMARY KEY(unidade_id, curso_id)',
        ]);

        // creates index for column `unidade_id`
        $this->createIndex(
            '{{%idx-unidade_curso-unidade_id}}',
            '{{%unidade_curso}}',
            'unidade_id'
        );

        // add foreign key for table `{{%unidade}}`
        $this->addForeignKey(
            '{{%fk-unidade_curso-unidade_id}}',
            '{{%unidade_curso}}',
            'unidade_id',
            '{{%unidade}}',
            'id',
            'CASCADE'
        );

        // creates index for column `curso_id`
        $this->createIndex(
            '{{%idx-unidade_curso-curso_id}}',
            '{{%unidade_curso}}',
            'curso_id'
        );

        // add foreign key for table `{{%curso}}`
        $this->addForeignKey(
            '{{%fk-unidade_curso-curso_id}}',
            '{{%unidade_curso}}',
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
        // drops foreign key for table `{{%unidade}}`
        $this->dropForeignKey(
            '{{%fk-unidade_curso-unidade_id}}',
            '{{%unidade_curso}}'
        );

        // drops index for column `unidade_id`
        $this->dropIndex(
            '{{%idx-unidade_curso-unidade_id}}',
            '{{%unidade_curso}}'
        );

        // drops foreign key for table `{{%curso}}`
        $this->dropForeignKey(
            '{{%fk-unidade_curso-curso_id}}',
            '{{%unidade_curso}}'
        );

        // drops index for column `curso_id`
        $this->dropIndex(
            '{{%idx-unidade_curso-curso_id}}',
            '{{%unidade_curso}}'
        );

        $this->dropTable('{{%unidade_curso}}');
    }
}
