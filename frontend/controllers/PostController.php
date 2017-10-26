<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\Posts;
use common\models\Comments;

/**
 * Site controller
 */
class PostController extends Controller
{
    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $posts = Posts::find()->where(['status' => 'publish']);

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $posts->count(),
        ]);

        $posts = $posts->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
                'posts' => $posts,
                'pagination' => $pagination,
        ]);			

    }
    
    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
	public function actionView($id)
    {
        return $this->renderSingle($id);
    }
    
    /**
     * Creates a new Comment model.
     * @param integer $id
     * @return mixed
     */
    public function actionAddcomment($id)
    {
        $comment = new Comments(); 
        $comment->save();
        return $this->renderSingle($id);
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function renderSingle($id)
    {
        $post = Posts::findOne($id);
        $comments = $post->getComments();
            
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $comments->count(),
        ]);
        
        $comments = $comments->orderBy('comment_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->render('single', [
                'post' => $post,
                'comments' => $comments,
                'pagination' => $pagination,
        ]);	
    }

}
