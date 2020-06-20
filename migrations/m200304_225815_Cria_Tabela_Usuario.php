<?php

use yii\db\Migration;

/**
 * Class m200617_225815_Cria_Tabela_Usuario
 */
class m200304_225815_Cria_Tabela_Usuario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()

    {
        $this->createTable('usuario',
            [
                'id' => $this->primaryKey(),
                'tipo_usuario'=> $this->string(60)->notNull(),
                'username'=> $this->string(60)->notNull(),
                'password'=> $this->string(60)->notNull(),
                'authKey'=> $this->string(60)->notNull(),
                'accessToken'=> $this->string(60)->notNull()
            ]
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200617_225815_Cria_Tabela_Usuario cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200617_225815_Cria_Tabela_Usuario cannot be reverted.\n";

        return false;
    }
    */
}
