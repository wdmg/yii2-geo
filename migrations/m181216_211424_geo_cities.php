<?php

use yii\db\Migration;

/**
 * Class m181216_211424_geo_cities
 */
class m181216_211424_geo_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%geo_cities}}', [
            'id' => $this->primaryKey(), // Primary key ID
            'country_id' => $this->integer()->null(), // Country ID (int) from `geo_countries`.`id`
            'region_id' => $this->integer()->null(), // Region ID (int) from `geo_regions`.`id`
            'title' => $this->string(255), // City title (string)
            'slug' => $this->string(64)->notNull(), // Region slug (string)
            'created_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Created date (timestamp)
            'updated_at'   => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Updated date (timestamp)
            'is_capital' => $this->boolean(), // Is capital of country flag (0/1)
            'is_published' => $this->boolean(), // Is published flag (0/1)
        ], $tableOptions);

        $this->addForeignKey(
            'fk_cities_to_countries',
            '{{%geo_cities}}',
            'country_id',
            '{{%geo_countries}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_cities_to_regions',
            '{{%geo_cities}}',
            'region_id',
            '{{%geo_regions}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->createIndex(
            'idx_geo_cities',
            '{{%geo_cities}}',
            [
                'title',
                'slug',
            ]
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx_geo_cities}}', '{{%geo_cities}}');

        $this->dropForeignKey(
            'fk_cities_to_countries',
            '{{%geo_cities}}'
        );

        $this->dropForeignKey(
            'fk_cities_to_regions',
            '{{%geo_cities}}'
        );

        $this->truncateTable('{{%geo_cities}}');
        $this->dropTable('{{%geo_cities}}');
    }

}
