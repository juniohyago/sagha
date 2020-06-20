<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%datas_professor}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%datas}}`
 * - `{{%professor}}`
 */
class m200617_225336_create_junction_table_for_datas_and_professor_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%datas_professor}}', [
            'datas_id' => $this->integer(),
            'professor_id' => $this->integer(),
            'PRIMARY KEY(datas_id, professor_id)',
        ]);

        // creates index for column `datas_id`
        $this->createIndex(
            '{{%idx-datas_professor-datas_id}}',
            '{{%datas_professor}}',
            'datas_id'
        );

        // add foreign key for table `{{%datas}}`
        $this->addForeignKey(
            '{{%fk-datas_professor-datas_id}}',
            '{{%datas_professor}}',
            'datas_id',
            '{{%datas}}',
            'id',
            'CASCADE'
        );

        // creates index for column `professor_id`
        $this->createIndex(
            '{{%idx-datas_professor-professor_id}}',
            '{{%datas_professor}}',
            'professor_id'
        );

        // add foreign key for table `{{%professor}}`
        $this->addForeignKey(
            '{{%fk-datas_professor-professor_id}}',
            '{{%datas_professor}}',
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
        // drops foreign key for table `{{%datas}}`
        $this->dropForeignKey(
            '{{%fk-datas_professor-datas_id}}',
            '{{%datas_professor}}'
        );

        // drops index for column `datas_id`
        $this->dropIndex(
            '{{%idx-datas_professor-datas_id}}',
            '{{%datas_professor}}'
        );

        // drops foreign key for table `{{%professor}}`
        $this->dropForeignKey(
            '{{%fk-datas_professor-professor_id}}',
            '{{%datas_professor}}'
        );

        // drops index for column `professor_id`
        $this->dropIndex(
            '{{%idx-datas_professor-professor_id}}',
            '{{%datas_professor}}'
        );

        $this->dropTable('{{%datas_professor}}');
    }
}
