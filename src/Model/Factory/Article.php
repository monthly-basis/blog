<?php
namespace LeoGalleguillos\Blog\Model\Factory;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;

class Article
{
    /**
     * Build from array.
     *
     * @param array $array
     * @return BlogEntity\Article
     */
    public function buildFromArray(
        array $array
    ): BlogEntity\Article {
        $articleEntity = new BlogEntity\Article();
        $articleEntity->setArticleId($array['blog_article_id'])
                      ->setBlogId($array['blog_id'])
                      ->setUserId($array['user_id'])
                      ->setTitle($array['title'])
                      ->setBody($array['body'])
                      ->setViews($array['views'])
                      ->setCreated(new DateTime($array['created']));

        return $articleEntity;
    }
}
