<?php
namespace MonthlyBasis\Blog\Model\Service;

use Generator;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Factory as BlogFactory;
use MonthlyBasis\Blog\Model\Service as BlogService;
use MonthlyBasis\Blog\Model\Table as BlogTable;

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
        $generator = $this->articleTable->selectWhereBlogIdAndDeletedIsNullOrderByCreatedDesc(
            $blogEntity->getBlogId()
        );
        foreach ($generator as $array) {
            yield $this->articleFactory->buildFromArray($array);
        }
    }
}
