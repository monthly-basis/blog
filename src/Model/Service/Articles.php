<?php
namespace LeoGalleguillos\Blog\Model\Service;

use Generator;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;

class Articles
{
    public function __construct(
        BlogFactory\Article $articleFactory,
        BlogTable\Article $articleTable
    ) {
        $this->articleFactory = $articleFactory;
        $this->articleTable   = $articleTable;
    }

    /**
     * Get articles.
     *
     * @param BlogEntity\Blog $blogEntity
     * @yield BlogEntity\Article
     * @return Generator
     */
    public function getArticles(BlogEntity\Blog $blogEntity): Generator
    {
        $generator = $this->blogArticleTable->selectWhereBlogIdOrderByCreatedDesc(
            $blogEntity->getBlogId()
        );
        foreach ($generator as $array) {
            yield $this->articleFactory->buildFromArray($array);
        }
    }
}
