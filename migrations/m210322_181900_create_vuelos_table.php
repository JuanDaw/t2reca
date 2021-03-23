<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vuelos}}`.
 */
class m210322_181900_create_vuelos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vuelos}}', [
            'id' => $this->bigPrimaryKey(),
            'origen_id' => $this->bigInteger()->notNull(),
            'destino_id' => $this->bigInteger()->notNull(),
            'salida' => $this->timestamp(0)->notNull(),
            'llegada' => $this->timestamp(0)->notNull(),
            'plazas' => $this->smallInteger()->notNull()->check('plazas >= 0'),
            'precio' => $this->decimal(7,2)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_vuelos_aeropuerto_origen',
            'vuelos',
            'origen_id',
            'aeropuertos',
            'id'
        );

        $this->addForeignKey(
            'fk_vuelos_aeropuerto_destino',
            'vuelos',
            'destino_id',
            'aeropuertos',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vuelos}}');
    }
}
