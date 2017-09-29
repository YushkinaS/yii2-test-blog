<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
<h1>Архив</h1>
<ul>
<?php foreach ($posts as $row): ?>
<?//= Html::encode("{$row->slug} ") ?>

    <li><a href="<?= Url::to(['post/view', 'post_slug' => $row->slug]); ?>"><?= Html::encode("{$row->title} ") ?></a>
        <?//= Html::encode("{$row->title} ({$row->content})") ?>:
        <?= $row->author ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>