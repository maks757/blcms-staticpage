<?php
namespace bl\cms\seo;

use bl\cms\seo\common\entities\StaticPage;
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
                    if (!empty($staticPageTranslation->seoKeywords)) {
                        $this->owner->view->registerMetaTag([
                            'name' => 'keywords',
                            'content' => html_entity_decode(strtr($staticPageTranslation->seoKeywords, $this->variables))
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