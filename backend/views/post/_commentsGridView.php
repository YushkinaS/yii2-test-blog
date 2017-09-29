<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

Pjax::begin();
$dataProvider = new ActiveDataProvider([
    'query' => $comments,
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'comment_author',
        'comment_content',
        [
            'class' => 'yii\grid\ActionColumn',
            'visibleButtons' => ['delete' => true, 'view' => false, 'update' => false]
        ],
        
    ]
]);
Pjax::end();