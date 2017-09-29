<?php
namespace frontend\controllers;

//убрать лишние юзы

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
     * Displays homepage.
     *
     * @return mixed
     */
	public function actionView( $post_slug = '')
    {
        $post = Posts::find()    
            ->where(['slug' => $post_slug])
            ->one();
            
        $comments = Comments::find()    
            ->where(['comment_post_id' => $post->id]);
            
        $pagination = new Pagination([
            'defaultPageSize' => 1,
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