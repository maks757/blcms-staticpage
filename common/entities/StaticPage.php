<?php

namespace maks757\seo_static_page\common\entities;

use maks757\seo_static_page\common\entities\language\Language;
use maks757\seo_static_page\common\entities\StaticPageTranslation;
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

    public function getTranslation(){
        return $this->hasOne(StaticPageTranslation::className(), ['page_key' => 'key'])
            ->onCondition([
                'language_id' => (empty(Language::getCurrent()) ?
                    Language::getDefault()->getPrimaryKey() :
                    Language::getCurrent()->getPrimaryKey())
            ]);
    }
}
