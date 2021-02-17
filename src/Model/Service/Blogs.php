<?php
namespace MonthlyBasis\Blog\Model\Service;

use Generator;
use Laminas\Db as LaminasDb;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Factory as BlogFactory;
use MonthlyBasis\Blog\Model\Table as BlogTable;

class Blogs
{
    public function __construct(
        BlogFactory\Blog $blogFactory,
        BlogTable\Blog $blogTable
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogTable   = $blogTable;
    }

    /**
     * @yield BlogEntity\Blog
     */
    public function getBlogs(): Generator
    {
        foreach ($this->blogTable->select() as $arrayObject) {
            yield $this->blogFactory->buildFromArray((array) $arrayObject);
        }
    }
}
