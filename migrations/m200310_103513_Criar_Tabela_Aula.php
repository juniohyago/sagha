<?php

use yii\db\Migration;

/**
 * Class m200310_103513_Criar_Tabela_Aula
 */
class m200310_103513_Criar_Tabela_Aula extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('aula',
            [
               'id'=>$this->primaryKey(),
                'descricao'=>$this->string(60)->notNull(),
                'fk_disciplinas_disponiveis_id'=>$this->integer()->notNull(),

                'fk_professor_id'=>$this->integer()->notNull(),

            ]
        );
        $this->addForeignKey
        (
            'fk_disciplinas_disponiveis_id',
            'aula',
            'fk_disciplinas_disponiveis_id',
            'disciplinas_disponiveis',
            'id',
            'CASCADE'
        );
        $this->addForeignKey
        (
            'fk_professor_id',
            'aula',
            'fk_professor_id',
            'professor',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_disciplinas_disponiveis_id','aula');
        $this->dropTable('aula');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_103513_Criar_Tabela_Aula cannot be reverted.\n";

        return false;
    }
    */
}
