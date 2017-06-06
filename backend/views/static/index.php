<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 * @var $this yii\web\View
 * @var $languages Language[]
*/

use maks757\seo_static_page\common\entities\language\Language;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Static pages';
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i>
                <?= 'Static pages list' ?>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <?php if (!empty($pages)): ?>
                        <thead>
                        <tr>
                            <th class="col-lg-<?= count($languages) > 1 ? '5' : '10' ?>"><?= 'Page key' ?></th>
                            <?php if(count($languages) > 1): ?>
                                <th class="col-lg-5"><?= 'Language' ?></th>
                            <?php endif; ?>
                            <th class="col-lg-1">Edit</th>
                            <th class="col-lg-1">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <td>
                                    <?= $page->key; ?>
                                </td>
                                <?php if(count($languages) > 1): ?>
                                    <td>
                                        <?php $translations = ArrayHelper::index($page->translations, 'language_id') ?>
                                        <?php foreach ($languages as $language): ?>
                                            <a href="<?= Url::to([
                                                'save-page',
                                                'page_key' => $page->key,
                                                'languageId' => $language->id
                                            ]) ?>"
                                               type="button"
                                               class="btn btn-<?= !empty($translations[$language->id]) ? 'primary' : 'danger'
                                               ?> btn-xs"><?= $language->name ?></a>
                                        <?php endforeach; ?>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <a href="<?= Url::to([
                                        'save-page',
                                        'page_key' => $page->key
                                    ])?>" class="fa fa-edit text-warning btn btn-default btn-sm">
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= Url::to([
                                        'remove',
                                        'key' => $page->key
                                    ])?>" class="fa fa-remove text-danger btn btn-default btn-sm">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>

                <a href="<?= Url::to(['/seo/static/save-page']); ?>"
                   class="btn btn-primary pull-right">
                    <i class="fa fa-user-plus"></i> <?= 'Add' ?>
                </a>
            </div>
        </div>
    </div>
</div>
