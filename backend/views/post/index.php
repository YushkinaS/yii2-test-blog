<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;


echo $this->render('_postsGridView', [
    'posts' => $posts,
    'pagination' => $pagination,
]);

