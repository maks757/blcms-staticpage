<?php

namespace maks757\seo_static_page\common\entities;

use maks757\seo_static_page\common\entities\StaticPageTranslation;
use bl\multilang\behaviors\TranslationBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "static_page".
 *
 * @property string $key
 *
 * @property StaticPageTranslation[] $translations
 * @property StaticPageTranslation $translation
 */
class StaticPage extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'translation' => [
                'class' => TranslationBehavior::className(),
                'translationClass' => StaticPageTranslation::className(),
                'relationColumn' => 'page_key'
            ]
        ];
    }
    
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
            [['key'], 'unique',
                'message' => 'Such key already exists.'],
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
    public function getTranslations()
    {
        return $this->hasMany(StaticPageTranslation::className(), ['page_key' => 'key']);
    }
}
