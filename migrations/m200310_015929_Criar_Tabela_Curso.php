<?php

use yii\db\Migration;

/**
 * Class m200310_015929_Criar_Tabela_Curso
 */
class m200310_015929_Criar_Tabela_Curso extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('curso',
            [
                'id'=>$this->primaryKey(),
                'descricao'=>$this->string(60)->notNull(),
                'tipo_curso'=>$this->string(60)->notNull(),
                'fk_coordenador_id'=>$this->integer()->notNull(),

            ]
        );
        $this->addForeignKey
        (
            'fk_coordenador_id',
            'curso',
            'fk_coordenador_id',
            'coordenador',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('curso');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_015929_Criar_Tabela_Curso cannot be reverted.\n";

        return false;
    }
    */
}
