<?php
namespace MonthlyBasis\Blog\Model\Service\Blogs\User;

use Generator;
use MonthlyBasis\Blog\Model\Factory as BlogFactory;
use MonthlyBasis\Blog\Model\Table as BlogTable;
use MonthlyBasis\User\Model\Entity as UserEntity;

class Get
{
    /**
     * Construct.
     *
     * @param BlogFactory\Blog $blogFactory
     * @param BlogTable\Blog $blogTable
     */
    public function __construct(
        BlogFactory\Blog $blogFactory,
        BlogTable\Blog $blogTable
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogTable   = $blogTable;
    }

    /**
     * Get blogs owned by user.
     *
     * @param UserEntity\User $userEntity
     * @yield BlogEntity\Blog
     * @return Generator
     */
    public function get(UserEntity\User $userEntity) : Generator
    {
        $generator = $this->blogTable->selectWhereUserId($userEntity->getUserId());
        foreach ($generator as $array) {
            yield $this->blogFactory->buildFromArray($array);
        }
    }
}
