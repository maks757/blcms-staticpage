<?php

namespace bl\cms\seo\common\entities;

use bl\cms\seo\common\entities\StaticPageTranslation;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "static_page".
 *
 * @property string $key
 *
 * @property StaticPageTranslation[] $staticPageTranslations
 */
class StaticPage extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        return $this->hasMany(StaticPageTranslation::className(), ['page_key' => 'key']);
    }
}
