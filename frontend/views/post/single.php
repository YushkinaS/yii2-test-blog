<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/*
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 4,
    ],
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
]);
*/

?>
<div><?= $post->author ?></div>
<h1><?= Html::encode("{$post->title}") ?></h1>
<div><?= Html::encode("{$post->content}") ?></div>

<?php $new_comment = $post->newComment(); ?>
<?php $form = ActiveForm::begin(['action' => ['addcomment', 'id' => $post->id]]); ?>
    <?= $form->field($new_comment, 'comment_content')->textInput() ?>
    <?= $form->field($new_comment, 'post_id')->hiddenInput(['value'=>$post->id])->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton('Add Comment', ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
    </div>
<?php ActiveForm::end(); ?>

            
<?php foreach ($comments as $row): ?>
<?//= Html::encode("{$row->slug} ") ?>

    <li>
        <?= $row->comment_author ?>:
        <?= Html::encode("{$row->comment_content}") ?>
       
    </li>
<?php endforeach; ?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>