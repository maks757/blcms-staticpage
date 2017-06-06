<?php
/**
 * Created by PhpStorm.
 * User: max
 * Name: Cherednyk Maxim
 * Phone: +380639960375
 * Email: maks757q@gmail.com
 * Date: 06.06.17
 * Time: 10:51
 */

namespace maks757\seo_static_page\common\entities\language;

use Yii;
use yii\db\ActiveRecord;

class Language extends ActiveRecord implements LanguageInterface {
    public static function tableName() {
        return 'language';
    }
    /**
     * @return Language
     */
    public static function getDefault() {
        return Language::findOne([
            'default' => true
        ]);
    }
    /**
     * @return Language Current language, or default
     */
    public static function getCurrent() {
        $language = Language::findOne([
            'lang_id' => Yii::$app->language
        ]);
        if(!$language) {
            $language = static::getDefault();
        }
        return $language;
    }
    public static function findOrDefault($languageId) {
        if (empty($languageId) || !$language = Language::findOne($languageId)) {
            $language = Language::find()
                ->where(['lang_id' => \Yii::$app->sourceLanguage])
                ->one();
        }
        return $language;
    }
    /**
     * @return string language key ['ru' or 'en' or 'pl'...]
     */
    public function getLanguageKey()
    {
        return $this->lang_id;
    }
    /**
     * @return string get name language ['Russian' or 'English', 'Polish'...]
     */
    public function getLanguageName()
    {
        return $this->name;
    }
    /**
     * @return string
     */
    public static function getPrimaryKeyFieldName()
    {
        return 'id';
    }
}