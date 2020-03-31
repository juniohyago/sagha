<?php

use yii\db\Migration;

/**
 * Class m200310_011932_Criar_Tabela_Professor
 */
class m200310_011932_Criar_Tabela_Professor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('professor',
            [
                'id'=> $this->primaryKey(),
                'cpf'=>$this->string(12)->notNull(),
                'nome'=>$this->string()->notNull(60),
                'sobreNome'=>$this->string()->notNull(60),
                'email'=>$this->string(50)->notNull(60),
                'telefone'=>$this->string(20)->notNull(60),
                'titulacao'=>$this->string()->notNull(60),
                'valor_hora_aula'=>$this->float()->notNull(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('professor');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_011932_Criar_Tabela_Professor cannot be reverted.\n";

        return false;
    }
    */
}
