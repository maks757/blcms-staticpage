<?php

namespace bl\cms\seo\common\entities;

use bl\multilang\entities\Language;
use bl\seo\behaviors\SeoDataBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "static_page_translation".
 *
 * @property integer $id
 * @property string $page_key
 * @property integer $language_id
 * @property string $title
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 * @property string $generate_keyword
 *
 * @property Language $language
 * @property StaticPage $pageKey
 */
class StaticPageTranslation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_page_translation';
    }

    public function behaviors()
    {
        return [
            'seoData' => [
                'class' => SeoDataBehavior::className()
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id'], 'integer'],
            [['generate_keyword'], 'boolean'],
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['page_key'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['page_key'], 'exist', 'skipOnError' => true, 'targetClass' => StaticPage::className(), 'targetAttribute' => ['page_key' => 'key']],
            // seo data
            [['seoUrl', 'seoTitle', 'seoDescription', 'seoKeywords'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_key' => 'Page key',
            'language_id' => 'Language ID',
            'title' => 'Title',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageKey()
    {
        return $this->hasOne(StaticPage::className(), ['key' => 'page_key']);
    }
}
