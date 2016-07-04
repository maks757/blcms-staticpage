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

    public function registerStaticSeoData()
    {
        if (!empty($this->key)) {
            $staticPage = StaticPage::findOne(['key' => $this->key]);
            if (!empty($staticPage)) {
                $staticPageTranslation = $staticPage->translation;
                if (!empty($staticPageTranslation)) {
                    $this->owner->view->title = $staticPageTranslation->seoTitle;
                    if (!empty($staticPageTranslation->seoDescription)) {
                        $this->owner->view->registerMetaTag([
                            'name' => 'description',
                            'content' => html_entity_decode($staticPageTranslation->seoDescription)
                        ]);
                    }
                    if (!empty($staticPageTranslation->seoKeywords)) {
                        $this->owner->view->registerMetaTag([
                            'name' => 'keywords',
                            'content' => html_entity_decode($staticPageTranslation->seoKeywords)
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