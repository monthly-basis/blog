<?php
namespace LeoGalleguillos\Blog\Model\Service;

use Generator;
use Laminas\Db as LaminasDb;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Table as BlogTable;

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
