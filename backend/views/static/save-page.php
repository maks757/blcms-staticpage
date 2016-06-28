<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var StaticPage $page
 */

use bl\cms\seo\common\entities\StaticPage;
use yii\widgets\ActiveForm;

$this->title = 'Save static page';
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
                    <?= $form->field($page, 'key', [
                        'inputOptions' => [
                            'class' => 'form-control'
                        ]])
                    ?>
                    <input type="submit" class="btn btn-primary pull-right" value="<?= Yii::t('', 'Save'); ?>">
                </div>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>