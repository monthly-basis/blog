<?php
namespace LeoGalleguillos\Blog\Model\Service;

use Generator;
use Laminas\Db as LaminasDb;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;

class Blogs
{
    public function __construct(
        BlogFactory\Blog $blogFactory,
        BlogTable\Blog $blogTable,
        LaminasDb\TableGateway\TableGateway $blogTableGateway
    ) {
        $this->blogFactory      = $blogFactory;
        $this->blogTable        = $blogTable;
        $this->blogTableGateway = $blogTableGateway;
    }

    /**
     * Get blogs.
     *
     * @yield BlogEntity\Blog
     * @return Generator
     */
    public function getBlogs() : Generator
    {
        $generator = $this->blogTable->selectOrderByCreatedDesc();
        foreach ($generator as $array) {
            yield $this->blogFactory->buildFromArray($array);
        }
    }
}
