<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var $languages Language[]
 * @var $selectedLanguage Language
 * @var StaticPageTranslation $page
 * @var ActiveForm $form
 */

use maks757\seo_static_page\common\entities\language\Language;
use maks757\seo_static_page\common\entities\StaticPageTranslation;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Save static page translation';
?>

<?php $form = ActiveForm::begin(['method'=>'post']) ?>
<?= $form->errorSummary($static_page_translation); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i>
                <?= 'Static page' ?>
            </div>
            <div class="panel-body">
                <?php if(count($languages) > 1): ?>
                    <div class="dropdown">
                        <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?= $selectedLanguage->name ?>
                            <span class="caret"></span>
                        </button>
                        <?php if(count($languages) > 1): ?>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <?php foreach($languages as $language): ?>
                                    <li>
                                        <a href="<?=
                                        Url::to([
                                            'save-page',
                                            'page_key' => $static_page_translation->page_key,
                                            'languageId' => $language->id]);
                                        ?>
                                        ">
                                            <?= $language->name; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($static_page_translation->page_key)): ?>
                    <h1>Static Page: <?=$static_page_translation->page_key; ?></h1>
                <?php else: ?>
                    <?= '<h1>Addition a new page</h1>'; ?>
                <?php endif; ?>
                <?= $form->field($static_page_translation, 'page_key', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]])
                ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i>
                <?= 'Seo Data' ?>
            </div>
            <div class="panel-body">
                <?= $form->field($static_page_translation, 'seoTitle', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->label('Seo Title')
                ?>

                <?= $form->field($static_page_translation, 'seoDescription', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->textarea(['rows' => 3])->label('Seo Description')
                ?>

                <?= $form->field($static_page_translation, 'seoKeywords', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->textarea(['rows' => 3])->label('Seo Keywords')
                ?>
            </div>
        </div>
    </div>
</div>

<input type="submit" class="btn btn-primary pull-right" value="Save">

<?php ActiveForm::end(); ?>
