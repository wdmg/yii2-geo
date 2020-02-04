<?php

use yii\db\Migration;

/**
 * Class m181216_211423_geo_regions
 */
class m181216_211423_geo_regions extends Migration
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

        $this->createTable('{{%geo_regions}}', [
            'id' => $this->primaryKey(), // Primary key ID
            'country_id' => $this->integer()->null(), // Country ID (int) from `geo_countries`.`id`
            'title' => $this->string(255), // Region title (string)
            'slug' => $this->string(64)->notNull()->unique(), // Region slug (string)
            'created_at'   => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'), // Created date (timestamp)
            'updated_at'   => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Updated date (timestamp)
            'is_published' => $this->boolean(), // Is published flag (0/1)
        ], $tableOptions);

        $this->addForeignKey(
            'fk_regions_to_countries',
            '{{%geo_regions}}',
            'country_id',
            '{{%geo_countries}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->createIndex(
            'idx_geo_regions',
            '{{%geo_regions}}',
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
        $this->dropIndex('{{%idx_geo_regions}}', '{{%geo_regions}}');

        $this->dropForeignKey(
            'fk_regions_to_countries',
            '{{%geo_regions}}'
        );

        $this->truncateTable('{{%geo_regions}}');
        $this->dropTable('{{%geo_regions}}');
    }

}
