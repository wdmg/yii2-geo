<?php

use yii\db\Migration;
use yii\db\Query;
use yii\db\BatchQueryResult;

/**
 * Class m181216_211425_geo_translations
 */
class m181216_211425_geo_translations extends Migration
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

        $this->createTable('{{%geo_translations}}', [
            'id' => $this->primaryKey(), // Primary key ID
            'language' => $this->string(16)->null(), // Language of translation (ISO)
            'source_id' => $this->integer()->null(), // Country/region/city ID (int)
            'source_type' => $this->integer()->notNull()->defaultValue(10), // Source type: 10 - countries, 20 - regions, 30 - cities
            'translation' => $this->string(255), // Translation of source (string)
            'created_at'   => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'), // Created date (timestamp)
            'updated_at'   => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Updated date (timestamp)
        ], $tableOptions);

        $this->createIndex(
            'idx_geo_translations',
            '{{%geo_translations}}',
            [
                'language',
                'source_type',
            ]
        );

        /*$this->addForeignKey(
            'fk_translations_to_countries',
            '{{%geo_translations}}',
            'source_id',
            '{{%geo_countries}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_translations_to_regions',
            '{{%geo_translations}}',
            'source_id',
            '{{%geo_regions}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_translations_to_cities',
            '{{%geo_translations}}',
            'source_id',
            '{{%geo_cities}}',
            'id',
            'SET NULL',
            'CASCADE'
        );*/

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx_geo_translations}}', '{{%geo_translations}}');

        /*$this->dropForeignKey(
            'fk_translations_to_countries',
            '{{%geo_translations}}'
        );
        $this->dropForeignKey(
            'fk_translations_to_regions',
            '{{%geo_translations}}'
        );
        $this->dropForeignKey(
            'fk_translations_to_cities',
            '{{%geo_translations}}'
        );*/
        $this->truncateTable('{{%geo_translations}}');
        $this->dropTable('{{%geo_translations}}');
    }

}
