<?php

use yii\db\Migration;

/**
 * Class m200306_002031_Criar_Tabela_Disciplinas_Disponiveis
 */
class m200306_002031_Criar_Tabela_Disciplinas_Disponiveis extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('disciplinas_disponiveis',
            [
                'id'=>$this->primaryKey(),
                'descricao'=>$this->string(60)->notNull(),
                'carga_horaria'=>$this->integer()->notNull(),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200306_002031_Criar_Tabela_Disciplinas_Disponiveis cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200306_002031_Criar_Tabela_Disciplinas_Disponiveis cannot be reverted.\n";

        return false;
    }
    */
}
