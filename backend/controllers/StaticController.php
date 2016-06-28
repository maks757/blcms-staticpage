<?php
namespace bl\cms\seo\backend\controllers;
use bl\cms\seo\common\entities\StaticPageTranslation;
use bl\cms\seo\common\entities\StaticPage;
use bl\multilang\entities\Language;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class StaticController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $pages = StaticPage::find()->with('translation')->all();
        return $this->render('index', [
            'pages' => $pages,
            'languages' => Language::findAll(['active' => true])
        ]);
    }

    public function actionSavePage($key = null)
    {
        if (!empty($key)) {
            $page = StaticPage::findOne($key);
        }
        else {
            $page = new StaticPage();
        }
        if (Yii::$app->request->post()) {
            if ($page->load(Yii::$app->request->post())) {
                if ($page->validate()) {
                    $page->save();
                    return $this->redirect('/admin/seo/static');
                }
            }
        }
        return $this->render('save-page', [
            'page' => $page
        ]);
    }
    
    public function actionRemove($key)
    {
        StaticPageTranslation::deleteAll(['page_key' => $key]);
        StaticPage::deleteAll(['key' => $key]);
        return $this->redirect(Url::to(['/seo/static/']));
    }

    public function actionSaveTranslation($page_key = null, $languageId = null)
    {
        if (!empty($page_key)) {
            $page = StaticPageTranslation::find()->where([
                'page_key' => $page_key,
                'language_id' => $languageId
            ])->one();
            if (empty($page)) {
                $page = new StaticPageTranslation();
                $page->page_key = $page_key;
            }
        }
        else {
            $page = new StaticPageTranslation();
        }
        if(Yii::$app->request->isPost) {
            if ($page->load(Yii::$app->request->post())) {
                if ($page->validate()) {
                    $page->language_id = $languageId;
                    $page->save();
                    return $this->redirect('/admin/seo/static');
                }
            }
        }
        return $this->render('save-translation', [
            'page' => $page,
            'staticPages' => StaticPage::find()->all(),
            'selectedLanguage' => Language::findOne($languageId),
            'languages' => Language::findAll(['active' => true])
        ]);
    }
}