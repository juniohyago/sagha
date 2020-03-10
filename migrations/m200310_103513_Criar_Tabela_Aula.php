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
                'fk_disciplinas_disponiveis_id'=>$this->integer()->notNull(),
                'fk_turmas_id'=>$this->integer()->notNull(),
                'dataHora_inicio'=>$this->dateTime()->notNull(),
                'dataHora_fim'=>$this->dateTime()->notNull(),
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
