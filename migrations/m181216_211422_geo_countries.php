<?php

use yii\db\Migration;

/**
 * Class m181216_211422_geo_countries
 */
class m181216_211422_geo_countries extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $geo_countries = json_decode(file_get_contents(__DIR__ . '/geo_countries.json'), true);
        foreach ($geo_countries as $country) {
            $country['created_at'] = date("Y-m-d H:i:s");
            $country['updated_at'] = date("Y-m-d H:i:s");
            $this->insert('{{%geo_countries}}', $country);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%geo_countries%}}');
    }

}
