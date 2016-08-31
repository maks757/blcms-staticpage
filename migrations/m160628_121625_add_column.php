<?php

use yii\db\Migration;

class m160628_121625_add_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('static_page_translation', 'generate_keyword', $this->boolean()->defaultValue(false));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('static_page_translation', 'generate_keyword');
    }
}
