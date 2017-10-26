<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    Status: <?=$model->status ?> 
   <?= Html::a($model->status == 'publish' ? 'To drafts' : 'Publish', 
                    Url::to(['post/update', 'id' => $model->id, 'status' => $model->status == 'publish' ? 'draft' : 'publish']), 
                    [
                        'class' => 'btn btn-success',
                        'title' => $model->status == 'publish' ? 'draft' : 'publish',
                        'aria-label' => $model->status == 'publish' ? 'draft' : 'publish',
                        'data-method' => 'post',
                       // 'data-pjax' => 'pjax-container',                        
                    ]);
    ?>
        
    <?//= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    
    <?//= $form->field($model, 'excerpt')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'date_created')->textInput() ?>

    <?//= $form->field($model, 'date_modified')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
