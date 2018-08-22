<?php
namespace LeoGalleguillos\Blog\Model\Factory;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Table as BlogTable;

class Article
{
    public function __construct(
        BlogTable\Article $articleTable
    ) {
        $this->articleTable = $articleTable;
    }

    public function buildFromArticleId(int $articleId): BlogEntity\Article
    {
        $array = $this->articleTable->selectWhereArticleId($articleId);
        return $this->buildFromArray(
            $array
        );
    }

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
        $articleEntity->setArticleId($array['article_id'])
                      ->setBlogId($array['blog_id'])
                      ->setUserId($array['user_id'])
                      ->setTitle($array['title'])
                      ->setBody($array['body'])
                      ->setViews($array['views'])
                      ->setCreated(new DateTime($array['created']));

        return $articleEntity;
    }
}
