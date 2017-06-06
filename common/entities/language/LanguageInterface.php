<?php
/**
 * Created by PhpStorm.
 * User: max
 * Name: Cherednyk Maxim
 * Phone: +380639960375
 * Email: maks757q@gmail.com
 * Date: 06.06.17
 * Time: 10:52
 */

namespace maks757\seo_static_page\common\entities\language;

use yii\db\ActiveRecordInterface;
interface LanguageInterface extends ActiveRecordInterface
{
    /**
     * @return string language key ['ru' or 'en' or 'pl'...]
     */
    public function getLanguageKey();
    /**
     * @return string name language ['Russian' or 'English', 'Polish'...]
     */
    public function getLanguageName();
    /**
     * @return string
     */
    public static function getPrimaryKeyFieldName();
    public static function getCurrent();
    public static function findOrDefault($languageId);
    public static function getDefault();
}