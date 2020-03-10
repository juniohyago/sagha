<?php

use yii\db\Migration;

/**
 * Class m200310_013346_Criar_Tabela_Datas_Professor
 */
class m200310_013346_Criar_Tabela_Datas_Professor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('datas_professor',
            [
                'id'=>$this->primaryKey(),
                'dataHora_inicio'=>$this->dateTime()->notNull(),
                'dataHora_fim'=>$this->dateTime()->notNull(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('datas_professor');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_013346_Criar_Tabela_Datas_Professor cannot be reverted.\n";

        return false;
    }
    */
}
