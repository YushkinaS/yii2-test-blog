<?php
namespace backend\controllers;

//убрать лишние юзы

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\Posts;
use common\models\Comments;

/**
 * Post controller
 */
class PostController extends Controller
{
    
    public function actionIndex()
    {
        $posts = Posts::find();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $posts->count(),
        ]);

        $posts = $posts->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit);

        return $this->render('index', [
                'posts' => $posts,
                'pagination' => $pagination,
        ]);	
    }
    
    public function actionUpdate($id,$status='')
    {
        $model = Posts::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->setStatus($status) && $model->save())
            return $this->renderUpdate($model);
        else 
            return $this->renderUpdate($model);
    }
    
    public function renderUpdate($model)
    {
        if (Yii::$app->request->isAjax)
            return $this->render('_form', [
                'model' => $model,
            ]);
        else 
            return $this->render('update', [
                'model' => $model,
            ]);
    }
    
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionDelete($id)
    {
        
        if ( $post = Posts::findOne($id) ) $post->delete();
        
        $posts = Posts::find();
        
        if (Yii::$app->request->isAjax)
            return $this->render('_postsGridView', [
                'posts' => $posts,
            ]);
        else
            return $this->redirect(['post/index']);
    }
    
    public function actionDeletecomment($id, $comment_id)
    {       
        if ( $comment = Comments::findOne($comment_id) ) $comment->delete();

        $post = Posts::findOne($id);
        $comments = $post->getComments();

        if (Yii::$app->request->isAjax)
            return $this->render('_commentsGridView', [
                'comments' => $comments,
            ]);
        else
            return $this->redirect(['post/update', 'id' => $id] );
        
    }

}
