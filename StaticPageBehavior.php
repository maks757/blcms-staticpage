<?php
namespace bl\cms\seo;

use bl\cms\seo\common\entities\StaticPage;
use bl\cms\seo\common\entities\StaticPageTranslation;
use yii\base\Behavior;
use yii\web\Controller;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @property Controller $owner
 */
class StaticPageBehavior extends Behavior
{
    public $key;
    public $variables = [];

    public function registerStaticSeoData()
    {
        if (!empty($this->key)) {
            $staticPage = StaticPage::findOne(['key' => $this->key]);
            if (!empty($staticPage)) {
                /**
                 *@var StaticPageTranslation $staticPageTranslation
                 */
                $staticPageTranslation = $staticPage->translation;
                if (!empty($staticPageTranslation)) {
                    if (!empty($staticPageTranslation->seoTitle)) {
                        $this->owner->view->title = strtr($staticPageTranslation->seoTitle, $this->variables);
                    }
                    if (!empty($staticPageTranslation->seoDescription)) {
                        $this->owner->view->registerMetaTag([
                            'name' => 'description',
                            'content' => html_entity_decode(strtr($staticPageTranslation->seoDescription, $this->variables))
                        ]);
                    }
                    if ($staticPageTranslation->generate_keyword) {
                        $parse_text = str_replace(['.', ','], ' ', $staticPageTranslation->seoTitle);
                        $array = array_unique(explode(' ', $parse_text));
                        foreach ($array as $key => $str) {
                            if (strlen(utf8_decode($str)) < 4) {
                                unset($array[$key]);
                            }
                        }
                        $keywords = implode(', ', $array);
                    }
                    if (!empty($staticPageTranslation->seoKeywords) || $staticPageTranslation->generate_keyword) {
                        $this->owner->view->registerMetaTag([
                            'name' => 'keywords',
                            'content' => html_entity_decode(strtr(($staticPageTranslation->generate_keyword ? $keywords : $staticPageTranslation->seoKeywords), $this->variables))
                        ]);
                    }
                }
            }
        }

    }
    
    public function getStaticPage() {

        if (!empty($this->key)) {
            return StaticPage::findOne(['key' => $this->key]);
        }
        return null;
    }
}