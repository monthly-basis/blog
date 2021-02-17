<?php
namespace MonthlyBasis\Blog\Model\Service\Blogs\User;

use MonthlyBasis\Blog\Model\Table as BlogTable;
use MonthlyBasis\User\Model\Entity as UserEntity;

class Count
{
    /**
     * Construct.
     *
     * @param BlogTable\Blog $blogTable
     */
    public function __construct(
        BlogTable\Blog $blogTable
    ) {
        $this->blogTable   = $blogTable;
    }

    /**
     * Get count of blogs owned by user.
     *
     * @param UserEntity\User $userEntity
     * @return int
     */
    public function getCount(UserEntity\User $userEntity) : int
    {
        return $this->blogTable->selectCountWhereUserId(
            $userEntity->getUserId()
        );
    }
}
