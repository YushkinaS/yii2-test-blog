<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;


echo Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']);

    
echo $this->render('_postsGridView', [
    'posts' => $posts,
    'pagination' => $pagination,
]);

