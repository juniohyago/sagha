<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%datas_aula}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%datas}}`
 * - `{{%aula}}`
 */
class m200618_230452_create_junction_table_for_datas_and_aula_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%datas_aula}}', [
            'datas_id' => $this->integer(),
            'aula_id' => $this->integer(),
            'PRIMARY KEY(datas_id, aula_id)',
        ]);

        // creates index for column `datas_id`
        $this->createIndex(
            '{{%idx-datas_aula-datas_id}}',
            '{{%datas_aula}}',
            'datas_id'
        );

        // add foreign key for table `{{%datas}}`
        $this->addForeignKey(
            '{{%fk-datas_aula-datas_id}}',
            '{{%datas_aula}}',
            'datas_id',
            '{{%datas}}',
            'id',
            'CASCADE'
        );

        // creates index for column `aula_id`
        $this->createIndex(
            '{{%idx-datas_aula-aula_id}}',
            '{{%datas_aula}}',
            'aula_id'
        );

        // add foreign key for table `{{%aula}}`
        $this->addForeignKey(
            '{{%fk-datas_aula-aula_id}}',
            '{{%datas_aula}}',
            'aula_id',
            '{{%aula}}',
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
            '{{%fk-datas_aula-datas_id}}',
            '{{%datas_aula}}'
        );

        // drops index for column `datas_id`
        $this->dropIndex(
            '{{%idx-datas_aula-datas_id}}',
            '{{%datas_aula}}'
        );

        // drops foreign key for table `{{%aula}}`
        $this->dropForeignKey(
            '{{%fk-datas_aula-aula_id}}',
            '{{%datas_aula}}'
        );

        // drops index for column `aula_id`
        $this->dropIndex(
            '{{%idx-datas_aula-aula_id}}',
            '{{%datas_aula}}'
        );

        $this->dropTable('{{%datas_aula}}');
    }
}
