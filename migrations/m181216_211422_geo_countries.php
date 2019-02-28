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

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%geo_countries}}', [
            'id' => $this->primaryKey(), // Primary key ID
            'title' => $this->string(255), // Region title (string)
            'slug' => $this->string(64)->notNull()->unique(), // Region slug (string)
            'created_at'   => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'), // Created date (timestamp)
            'updated_at'   => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Updated date (timestamp)
            'is_published' => $this->boolean(), // Is published flag (0/1)
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%geo_countries}}');
        $this->dropTable('{{%geo_countries}}');
    }

}
