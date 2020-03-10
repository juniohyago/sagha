<?php

use yii\db\Migration;

/**
 * Class m200306_001005_Criar_Tabela_Coordenador
 */
class m200306_001005_Criar_Tabela_Coordenador extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('coordenador',
            [
                'id'=>$this->primaryKey(),
                'nome'=>$this->string(60)->notNull(),
                'sobre_nome'=>$this->string(60)->notNull(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('coordenador');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200306_001005_Criar_Tabela_Coordenador cannot be reverted.\n";

        return false;
    }
    */
}
