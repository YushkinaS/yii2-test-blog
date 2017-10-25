<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $posts common\models\Posts */
/* @var $comments common\models\Comments */

?>
<?php
    $this->registerJs(
        '$("document").ready(function(){
            $("#new_note").on("pjax:end", function() {
            $.pjax.reload({container:"#notes"});  //Reload GridView
        });
    });'
    );
?>

<div><?= $post->author ?></div>
<h1><?= Html::encode("{$post->title}") ?></h1>
<div><?= Html::encode("{$post->content}") ?></div>

<?php Pjax::begin(['id' => 'new_note']) ?>
<?php $new_comment = $post->newComment(); ?>
<?php $form = ActiveForm::begin(['action' => ['addcomment', 'id' => $post->id], 'options' => ['data-pjax' => true]]); ?>
    <?= $form->field($new_comment, 'comment_content')->textInput() ?>
    <?= $form->field($new_comment, 'post_id')->hiddenInput(['value'=>$post->id])->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton('Add Comment', ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>

<?php Pjax::begin(['id' => 'notes']) ?>            
<?php foreach ($comments as $row): ?>
<?//= Html::encode("{$row->slug} ") ?>

    <li>
        <?= $row->comment_author ?>:
        <?= Html::encode("{$row->comment_content}") ?>
       
    </li>
<?php endforeach; ?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<?php Pjax::end() ?>