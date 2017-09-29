<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


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
<h1>Заголовок</h1>

        <?= Html::encode("{$post->title} ({$post->content})") ?>:
        <?= $post->author ?>

<?php foreach ($comments as $row): ?>
<?//= Html::encode("{$row->slug} ") ?>

    <li>
        <?= $row->comment_author ?>
        <?= Html::encode("{$row->comment_content}") ?>
       
    </li>
<?php endforeach; ?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>