<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $posts common\models\Posts */
/* @var $pagination yii\data\Pagination */

?>
<?php Pjax::begin(); ?>    
<h1>Архив</h1>

<?php foreach ($posts as $row): ?>
<?//= Html::encode("{$row->slug} ") ?>

    <div style="margin-bottom:20px;"><a href="<?= Url::to(['post/view', 'id' => $row->id]); ?>"><?= Html::encode("{$row->title} ") ?></a>
        <?//= Html::encode("{$row->title} ({$row->content})") ?>
        <div><?= $row->author ?></div>
    </div>
<?php endforeach; ?>


<?= LinkPager::widget(['pagination' => $pagination]) ?>
<?php Pjax::end(); ?>