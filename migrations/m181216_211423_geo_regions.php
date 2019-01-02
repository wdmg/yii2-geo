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

        $geo_regions = json_decode(file_get_contents(__DIR__ . '/geo_regions.json'), true);
        foreach ($geo_regions as $region) {
            $region['created_at'] = date("Y-m-d H:i:s");
            $region['updated_at'] = date("Y-m-d H:i:s");
            $this->insert('{{%geo_regions}}', $region);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%geo_regions%}}');
    }

}
