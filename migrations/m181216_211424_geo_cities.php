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

        $geo_cities = json_decode(file_get_contents(__DIR__ . '/geo_cities.json'), true);
        foreach ($geo_cities as $city) {
            $city['created_at'] = date("Y-m-d H:i:s");
            $city['updated_at'] = date("Y-m-d H:i:s");
            $this->insert('{{%geo_cities}}', $city);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%geo_cities%}}');
    }

}
