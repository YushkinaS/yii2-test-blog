<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $posts yii\db\ActiveQuery */
/* @var $pagination yii\data\Pagination */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;

echo Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']);
    
echo $this->render('_postsGridView', [
    'posts' => $posts,
    'pagination' => $pagination,
]);

