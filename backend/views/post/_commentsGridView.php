<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

Pjax::begin(['id' => 'pjax-container']);
$dataProvider = new ActiveDataProvider([
    'query' => $comments,
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'comment_author',
        'comment_content',
        [
            'format' => 'raw',
            'value' => function ($data) {
                ob_start();
                $form = ActiveForm::begin(['action' => ['editcomment', 'id' => $data->comment_post_id, 'comment_id' => $data->comment_id], 'options' => ['data-pjax' => true]]); 
                echo $form->field($data, 'comment_content')->textInput()->label(false);

                echo Html::submitButton('Edit', ['class' => 'btn btn-primary', 'name' => 'comment-button']);
  
                ActiveForm::end();

                return ob_get_clean();
            }
        ],
        [
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a('', 
                    Url::to(['post/deletecomment', 'id' => $data->comment_post_id, 'comment_id' => $data->comment_id]), 
                    [
                        'class' => 'glyphicon glyphicon-trash',
                        'data-confirm' => 'Are you sure you want to delete this item?',
                        'title' => 'Delete',
                        'aria-label' => 'Delete',
                        'data-method' => 'post',
                        'data-pjax' => 'pjax-container',
                      /*  'onclick' => "
                                if (confirm('ok?')) {
                                    $.ajax($(this).href(), {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#pjax-container'});
                                    });
                                }
                                return false;
                            ",*/
                        
                    ]);


            }
        ] 
    ]
]);
Pjax::end();