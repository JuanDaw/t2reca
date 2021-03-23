<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reservas}}`.
 */
class m210323_143754_create_reservas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reservas}}', [
            'id' => $this->bigPrimaryKey(),
            'usuario_id' => $this->bigInteger()->notNull(),
            'vuelo_id' => $this->bigInteger()->notNull(),
            'asiento' => $this->smallInteger()->notNull()->check('asiento > 0'),
            'UNIQUE (vuelo_id, asiento)',
            'UNIQUE (usuario_id, vuelo_id)',
        ]);

        $this->addForeignKey(
            'fk_reservas_usuarios',
            'reservas',
            'usuario_id',
            'usuarios',
            'id'
        );

        $this->addForeignKey(
            'fk_reservas_vuelos',
            'reservas',
            'vuelo_id',
            'vuelos',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reservas}}');
    }
}
