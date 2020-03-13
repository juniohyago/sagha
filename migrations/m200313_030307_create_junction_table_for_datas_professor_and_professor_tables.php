<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%datas_professor_professor}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%datas_professor}}`
 * - `{{%professor}}`
 */
class m200313_030307_create_junction_table_for_datas_professor_and_professor_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%datas_professor_professor}}', [
            'datas_professor_id' => $this->integer(),
            'professor_id' => $this->integer(),
            'PRIMARY KEY(datas_professor_id, professor_id)',
        ]);

        // creates index for column `datas_professor_id`
        $this->createIndex(
            '{{%idx-datas_professor_professor-datas_professor_id}}',
            '{{%datas_professor_professor}}',
            'datas_professor_id'
        );

        // add foreign key for table `{{%datas_professor}}`
        $this->addForeignKey(
            '{{%fk-datas_professor_professor-datas_professor_id}}',
            '{{%datas_professor_professor}}',
            'datas_professor_id',
            '{{%datas_professor}}',
            'id',
            'CASCADE'
        );

        // creates index for column `professor_id`
        $this->createIndex(
            '{{%idx-datas_professor_professor-professor_id}}',
            '{{%datas_professor_professor}}',
            'professor_id'
        );

        // add foreign key for table `{{%professor}}`
        $this->addForeignKey(
            '{{%fk-datas_professor_professor-professor_id}}',
            '{{%datas_professor_professor}}',
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
        // drops foreign key for table `{{%datas_professor}}`
        $this->dropForeignKey(
            '{{%fk-datas_professor_professor-datas_professor_id}}',
            '{{%datas_professor_professor}}'
        );

        // drops index for column `datas_professor_id`
        $this->dropIndex(
            '{{%idx-datas_professor_professor-datas_professor_id}}',
            '{{%datas_professor_professor}}'
        );

        // drops foreign key for table `{{%professor}}`
        $this->dropForeignKey(
            '{{%fk-datas_professor_professor-professor_id}}',
            '{{%datas_professor_professor}}'
        );

        // drops index for column `professor_id`
        $this->dropIndex(
            '{{%idx-datas_professor_professor-professor_id}}',
            '{{%datas_professor_professor}}'
        );

        $this->dropTable('{{%datas_professor_professor}}');
    }
}
