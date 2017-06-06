<?php
namespace maks757\seo_static_page\backend\controllers;

use maks757\seo_static_page\common\entities\StaticPageTranslation;
use maks757\seo_static_page\common\entities\StaticPage;
use bl\multilang\entities\Language;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class StaticController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'roles' => ['viewStaticPages'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['save-page'],
                        'roles' => ['editStaticPage'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['remove'],
                        'roles' => ['deleteStaticPage'],
                        'allow' => true,
                    ],
                ],
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $pages = StaticPage::find()->with('translations')->all();
        return $this->render('index', [
            'pages' => $pages,
            'languages' => Language::findAll(['active' => true])
        ]);
    }

    /**
     * @param string $key
     * @return \yii\web\Response
     */
    public function actionRemove($key)
    {
        StaticPageTranslation::deleteAll(['page_key' => $key]);
        StaticPage::deleteAll(['key' => $key]);
        return $this->redirect(Url::to(['/seo/static/']));
    }

    /**
     * @param string $page_key
     * @param integer $languageId
     * @return mixed
     * @throws BadRequestHttpException
     * @throws BadRequestHttpException
     */
    public function actionSavePage($page_key = null, $languageId = null)
    {
        $selected_language = (!empty($languageId)) ? Language::findOne($languageId) : Language::findOne(['lang_id' => Yii::$app->language]);

        if (!empty($selected_language)) {

            if (!empty($page_key)) {
                $static_page = StaticPage::findOne($page_key);
                if (!empty($static_page)) {
                    $static_page_translation = StaticPageTranslation::find()->where([
                        'page_key' => $page_key,
                        'language_id' => $selected_language->id,
                    ])->one();
                    if (empty($static_page_translation)) {
                        $static_page_translation = new StaticPageTranslation();
                        $static_page_translation->page_key = $static_page->key;
                    }
                } else {
                    throw new BadRequestHttpException('Such static page doesn\'t exist. You can\'t add translation.');
                }
            }

            else {
                $static_page = new StaticPage();
                $static_page_translation = new StaticPageTranslation();
            }

            if (Yii::$app->request->isPost) {
                if ($static_page_translation->load(Yii::$app->request->post())) {
                    if (empty($static_page->key)) {
                        $static_page->key = $static_page_translation->page_key;
                        if ($static_page->validate()) {
                            $static_page->save();
                        }
                        else throw new BadRequestHttpException('Sorry, such static page already exist.');
                    }
                    $static_page_translation->language_id = $selected_language->id;
                    $static_page_translation->save();
                }
            }

            return $this->render('save-page', [
                'static_page' => $static_page,
                'static_page_translation' => $static_page_translation,
                'staticPage' => StaticPage::find()->all(),
                'selectedLanguage' => $selected_language,
                'languages' => Language::findAll(['active' => true])
            ]);
        }
        else throw new BadRequestHttpException('You can\'t add this static page translation, because such language doesn\'t exist');
    }

}