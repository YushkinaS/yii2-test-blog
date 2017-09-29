<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

Pjax::begin();
$dataProvider = new ActiveDataProvider([
    'query' => $posts,
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
       // ['class' => 'yii\grid\SerialColumn'],
       'id',
       [
        'attribute' => 'date_modified',
        'label'     => 'Changed',
        'headerOptions'=>['style'=>'max-width: 50px;'],
        'contentOptions'=>['style'=>'max-width: 50px;'],
       ],
       'status',
        [
            'format' => 'html',
            'value' => function ($data) {
                return '<a href="' . Url::to(['post/view', 'post_slug' => $data->slug]) . '">' . $data->title . '</a>';
            },
        ],
     //   'author',
        [
            'class' => 'yii\grid\ActionColumn',

        ],
        
    ]
]);
Pjax::end();