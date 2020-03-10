<?php

use yii\db\Migration;

/**
 * Class m200310_161837_Criar_Tabela_Aderencia_Professor
 */
class m200310_161837_Criar_Tabela_Aderencia_Professor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable
        ('aderencia_professor',
            [
                'fk_professor_id'=>$this->primaryKey(),
                'fk_Disciplinas_Disponiveis_id'=>$this->primaryKey(),
            ]
        );
        $this->addForeignKey
        (
            'fk_professor_id',
            'aderencia_professor',
            'fk_professor_id',
            'professor',
            'id',
            'CASCADE'
        );
        $this->addForeignKey
        (
            'fk_Disciplinas_Disponiveis_id',
            'aderencia_professor',
            'fk_Disciplinas_Disponiveis_id',
            'disciplinas_disponiveis',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey
        (
            'fk_professor_id',
            'aderencia_professor'
        );
        $this->dropForeignKey
        (
            'fk_Disciplinas_Disponiveis_id',
            'aderencia_professor'
        );
        $this->dropTable('aderencia_professor');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_161837_Criar_Tabela_Aderencia_Professor cannot be reverted.\n";

        return false;
    }
    */
}
