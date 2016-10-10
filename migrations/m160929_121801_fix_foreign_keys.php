<?php

use yii\db\Migration;

class m160929_121801_fix_foreign_keys extends Migration
{
    public function up()
    {
        $this->dropForeignKey('static_page_translation:page_key', 'static_page_translation');
        $this->dropForeignKey('static_page_translation:language_id', 'static_page_translation');

        $this->addForeignKey('static_page_translation:page_key', 'static_page_translation', 'page_key', 'static_page', 'key', 'cascade', 'cascade');
        $this->addForeignKey('static_page_translation:language_id', 'static_page_translation', 'language_id', 'language', 'id', 'cascade', 'cascade');

    }

    public function down()
    {
        return true;
    }

}
