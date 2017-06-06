<?php

/**
 * Created by PhpStorm.
 * User: max
 * Name: Cherednyk Maxim
 * Phone: +380639960375
 * Email: maks757q@gmail.com
 * Date: 06.06.17
 * Time: 10:33
 */

use yii\db\Schema;
use yii\db\Migration;

class m160215_153560_create_language_table extends Migration {
    public function safeUp() {
        if(empty(Yii::$app->db->schema->getTableSchema('language'))) {
            $this->createTable('language', [
                'id' => $this->primaryKey(),
                'name' => $this->string(100)->notNull(),
                'lang_id' => $this->string(10)->notNull(),
                'show' => $this->boolean(),
                'active' => $this->boolean(),
                'default' => $this->boolean()
            ]);
            $this->createIndex('language_lang_id_index', 'language', ['lang_id']);

            $this->insert('language', [
                'name' => 'English',
                'lang_id' => 'en-US',
                'show' => true,
                'active' => true,
                'default' => true
            ]);
        }
    }
    public function safeDown() {
        $this->dropTable('language');
        return true;
    }
}