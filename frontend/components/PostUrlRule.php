<?php
namespace app\components;

use Yii;
use yii\web\UrlRuleInterface;
use yii\base\Object;
use yii\web\UrlRule;

class PostUrlRule implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'post/view') {
            if (isset($params['id'])) {
                $slug = Yii::$app->db->createCommand('SELECT slug FROM posts WHERE id = '.$params['id'])
						->queryScalar();
                if ($slug) {
                    return 'blog/'.$slug;
                }
                else {
                    return false;
                }
                
            }
        }
        return false; 
    }

    public function parseRequest($manager, $request) 
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('%^blog/(\w+)?$%', $pathInfo, $matches)) {
			if ( !empty($matches[1]) ) {
                $id = Yii::$app->db->createCommand('SELECT id FROM posts WHERE slug LIKE "'.$matches[1].'"')
						->queryScalar();
                        
                if ($id) {
                    $params['id'] = $id;
			        return ['post/view',$params];	
                }
                else {
                    return false;
                }
			
		
			}
        }
        return false; 
    }
}
