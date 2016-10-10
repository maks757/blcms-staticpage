<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var $languages Language[]
 * @var $selectedLanguage Language
 * @var StaticPageTranslation $page
 */

use bl\cms\seo\common\entities\StaticPageTranslation;
use bl\multilang\entities\Language;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Save static page translation';
?>

<?php $form = ActiveForm::begin(['method'=>'post']) ?>
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
                                            'save-translation',
                                            'page_key' => $page->page_key,
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
                <label for="page_key">Page key</label>
                <select class="form-control" name="page_key">
                    <option value="">-- <?= 'Empty' ?> --</option>
                    <?php if(!empty($staticPages)): ?>
                        <?php foreach($staticPages as $staticPage): ?>
                            <option <?= $staticPage->key == $page->page_key ? 'selected' : '' ?> value="<?= $page->page_key?>">
                                <?= $page->page_key; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                

                <?= $form->field($page, 'title', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]])
                ?>
                <?= $form->field($page, 'text', [
                    'inputOptions' => [
                        'class' => 'form-control'
                    ]
                ])->widget(TinyMce::className(), [
                    'options' => ['rows' => 20],
                    'language' => 'ru',
                    'clientOptions' => [
                        'relative_urls' => false,
                        'plugins' => [
                            'textcolor colorpicker',
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste",
                            'image'
                        ],
                        'toolbar' => "undo redo | forecolor backcolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]])
                ?>
                <input type="submit" class="btn btn-primary pull-right" value="<?= Yii::t('', 'Save'); ?>">
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
