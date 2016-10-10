<?php

use yii\db\Migration;

/**
 * Handles the creation for table `static_page` and 'static_page_translation'.
 */
class m160628_121611_create_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('static_page', [
            'key' => $this->string([50])->notNull(),
        ]);
        $this->addPrimaryKey('key', 'static_page', 'key');
        
        $this->createTable('static_page_translation', [
            'id' => $this->primaryKey(),
            'page_key' => $this->string([50]),
            'language_id' => $this->integer(),
            'title' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
        $this->addForeignKey('static_page_translation:page_key', 'static_page_translation', 'page_key', 'static_page', 'key');
        $this->addForeignKey('static_page_translation:language_id', 'static_page_translation', 'language_id', 'language', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('static_page_translation:language_id', 'static_page_translation');
        $this->dropForeignKey('static_page_translation:page_key', 'static_page_translation');
        $this->dropTable('static_page_translation');
        $this->dropTable('static_page');
    }
}
