<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%disciplinas_disponiveis_curso}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%disciplinas_disponiveis}}`
 * - `{{%curso}}`
 */
class m200617_225446_create_junction_table_for_disciplinas_disponiveis_and_curso_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%disciplinas_disponiveis_curso}}', [
            'disciplinas_disponiveis_id' => $this->integer(),
            'curso_id' => $this->integer(),
            'PRIMARY KEY(disciplinas_disponiveis_id, curso_id)',
        ]);

        // creates index for column `disciplinas_disponiveis_id`
        $this->createIndex(
            '{{%idx-disciplinas_disponiveis_curso-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_curso}}',
            'disciplinas_disponiveis_id'
        );

        // add foreign key for table `{{%disciplinas_disponiveis}}`
        $this->addForeignKey(
            '{{%fk-disciplinas_disponiveis_curso-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_curso}}',
            'disciplinas_disponiveis_id',
            '{{%disciplinas_disponiveis}}',
            'id',
            'CASCADE'
        );

        // creates index for column `curso_id`
        $this->createIndex(
            '{{%idx-disciplinas_disponiveis_curso-curso_id}}',
            '{{%disciplinas_disponiveis_curso}}',
            'curso_id'
        );

        // add foreign key for table `{{%curso}}`
        $this->addForeignKey(
            '{{%fk-disciplinas_disponiveis_curso-curso_id}}',
            '{{%disciplinas_disponiveis_curso}}',
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
        // drops foreign key for table `{{%disciplinas_disponiveis}}`
        $this->dropForeignKey(
            '{{%fk-disciplinas_disponiveis_curso-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_curso}}'
        );

        // drops index for column `disciplinas_disponiveis_id`
        $this->dropIndex(
            '{{%idx-disciplinas_disponiveis_curso-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_curso}}'
        );

        // drops foreign key for table `{{%curso}}`
        $this->dropForeignKey(
            '{{%fk-disciplinas_disponiveis_curso-curso_id}}',
            '{{%disciplinas_disponiveis_curso}}'
        );

        // drops index for column `curso_id`
        $this->dropIndex(
            '{{%idx-disciplinas_disponiveis_curso-curso_id}}',
            '{{%disciplinas_disponiveis_curso}}'
        );

        $this->dropTable('{{%disciplinas_disponiveis_curso}}');
    }
}
