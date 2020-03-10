<?php

use yii\db\Migration;

/**
 * Class m200310_155941_Criar_Tabela_Grade_Curricular
 */
class m200310_155941_Criar_Tabela_Grade_Curricular extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable
        (
            'grade_curricular',
            [
                'fk_disciplinas_disponiveis_id'=>$this->primaryKey(),
                'fk_curso_id'=>$this->primaryKey(),
            ]
        );
        $this->addForeignKey
        (
            'fk_disciplinas_disponiveis_id',
            'grade_curricular',
            'fk_disciplinas_disponiveis_id',
            'disciplinas_disponiveis',
            'id',
            'CASCADE'
        );
        $this->addForeignKey
        (
            'fk_curso_id',
            'grade_curricular',
            'fk_curso_id',
            'curso',
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
            'fk_disciplinas_disponiveis_id',
            'grade_curricular'
        );
        $this->dropForeignKey
        (
            'fk_curso_id',
            'grade_curricular'
        );
        $this->dropTable('grade_curricular');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_155941_Criar_Tabela_Grade_Curricular cannot be reverted.\n";

        return false;
    }
    */
}
