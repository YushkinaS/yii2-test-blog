<?php
namespace backend\controllers;

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
    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $posts = Posts::find();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $posts->count(),
        ]);

        $posts = $posts->orderBy('id DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit);

        return $this->render('index', [
                'posts' => $posts,
                'pagination' => $pagination,
        ]);	
    }
    
    /**
     * Updates an existing Posts model.
     * @param integer $id
     * @param string $status
     * @return mixed
     */
    public function actionUpdate($id,$status='')
    {
        $model = Posts::findOne($id); 
        if (Yii::$app->user->can('updatePost', ['post' => $model])) {
            

            if ($model->load(Yii::$app->request->post()) && $model->setStatus($status) && $model->save())
                return $this->renderUpdate($model);
            else 
                return $this->renderUpdate($model);
        }
        else {
            return $this->render('forbidden');
        }
    }
    
    /**
     * Render form for editing the Posts model 
     * @param common\models\Posts $model
     * @return mixed
     */
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
    
    /**
     * Creates a new Posts model.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('createPost')) { 
            $model = new Posts();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else {
            return $this->render('forbidden');
        }
    }
  
    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */  
    public function actionDelete($id)
    {        
        if ( $post = Posts::findOne($id) ) $post->delete();
        
        $posts = Posts::find()->orderBy('id DESC');
        
        if (Yii::$app->request->isAjax)
            return $this->render('_postsGridView', [
                'posts' => $posts,
            ]);
        else
            return $this->redirect(['post/index']);
    }
    
    /**
     * Deletes a post comment
     * @param integer $id
     * @param integer $comment_id
     * @return mixed
     */     
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
