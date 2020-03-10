<?php

use yii\db\Migration;

/**
 * Class m200310_024724_Criar_Tabela_Turmas
 */
class m200310_024724_Criar_Tabela_Turmas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('turmas',
            [
                'id'=>$this->primaryKey(),
                'descricao'=>$this->string()->notNull(),
                'periodo'=>$this->string()->notNull(),
                'fk_curso_id'=>$this->integer()->notNull(),

            ]

        );
        $this->addForeignKey
        (
            'fk_curso_id',
            'turmas',
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
        $this->dropForeignKey('fk_curso_id','turmas');
        $this->dropTable('turmas');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_024724_Criar_Tabela_Turmas cannot be reverted.\n";

        return false;
    }
    */
}
