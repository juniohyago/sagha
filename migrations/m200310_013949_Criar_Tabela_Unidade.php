<?php

use yii\db\Migration;

/**
 * Class m200310_013949_Criar_Tabela_Unidade
 */
class m200310_013949_Criar_Tabela_Unidade extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('unidade',
            [
                'id'=>$this->primaryKey(),
                'descricao'=>$this->string(60)->notNull(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200310_013949_Criar_Tabela_Unidade cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_013949_Criar_Tabela_Unidade cannot be reverted.\n";

        return false;
    }
    */
}