<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%disciplinas_disponiveis_professor}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%disciplinas_disponiveis}}`
 * - `{{%professor}}`
 */
class m200313_025938_create_junction_table_for_disciplinas_disponiveis_and_professor_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%disciplinas_disponiveis_professor}}', [
            'disciplinas_disponiveis_id' => $this->integer(),
            'professor_id' => $this->integer(),
            'PRIMARY KEY(disciplinas_disponiveis_id, professor_id)',
        ]);

        // creates index for column `disciplinas_disponiveis_id`
        $this->createIndex(
            '{{%idx-disciplinas_disponiveis_professor-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_professor}}',
            'disciplinas_disponiveis_id'
        );

        // add foreign key for table `{{%disciplinas_disponiveis}}`
        $this->addForeignKey(
            '{{%fk-disciplinas_disponiveis_professor-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_professor}}',
            'disciplinas_disponiveis_id',
            '{{%disciplinas_disponiveis}}',
            'id',
            'CASCADE'
        );

        // creates index for column `professor_id`
        $this->createIndex(
            '{{%idx-disciplinas_disponiveis_professor-professor_id}}',
            '{{%disciplinas_disponiveis_professor}}',
            'professor_id'
        );

        // add foreign key for table `{{%professor}}`
        $this->addForeignKey(
            '{{%fk-disciplinas_disponiveis_professor-professor_id}}',
            '{{%disciplinas_disponiveis_professor}}',
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
        // drops foreign key for table `{{%disciplinas_disponiveis}}`
        $this->dropForeignKey(
            '{{%fk-disciplinas_disponiveis_professor-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_professor}}'
        );

        // drops index for column `disciplinas_disponiveis_id`
        $this->dropIndex(
            '{{%idx-disciplinas_disponiveis_professor-disciplinas_disponiveis_id}}',
            '{{%disciplinas_disponiveis_professor}}'
        );

        // drops foreign key for table `{{%professor}}`
        $this->dropForeignKey(
            '{{%fk-disciplinas_disponiveis_professor-professor_id}}',
            '{{%disciplinas_disponiveis_professor}}'
        );

        // drops index for column `professor_id`
        $this->dropIndex(
            '{{%idx-disciplinas_disponiveis_professor-professor_id}}',
            '{{%disciplinas_disponiveis_professor}}'
        );

        $this->dropTable('{{%disciplinas_disponiveis_professor}}');
    }
}
