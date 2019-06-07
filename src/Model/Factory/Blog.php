<?php
namespace LeoGalleguillos\Blog\Model\Factory;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\User\Model\Factory as UserFactory;

class Blog
{
    /**
     * Construct
     *
     * @param BlogTable\Blog $blogTable
     * @param UserFactory\User $userFactory
     */
    public function __construct(
        BlogTable\Blog $blogTable,
        UserFactory\User $userFactory
    ) {
        $this->blogTable   = $blogTable;
        $this->userFactory = $userFactory;
    }

    /**
     * Build from array.
     *
     * @param array $array
     * @return BlogEntity\Blog
     */
    public function buildFromArray(
        array $array
    ) : BlogEntity\Blog {
        $blogEntity = new BlogEntity\Blog();
        $blogEntity->setBlogId($array['blog_id'])
                   ->setCreated(new DateTime($array['created']))
                   ->setDescription($array['description'])
                   ->setName($array['name'])
                   ->setSlug($array['slug'])
                   ->setViews($array['views']);

        $blogEntity->setUser(
            $this->userFactory->buildFromUserId($array['user_id'])
        );

        return $blogEntity;
    }

    /**
     * Build from blog ID.
     *
     * @param int $blogId
     * @return BlogEntity\Blog
     */
    public function buildFromBlogId(
        int $blogId
    ) : BlogEntity\Blog {
        return $this->buildFromArray(
            $this->blogTable->selectWhereBlogId($blogId)
        );
    }

    /**
     * Build from slug.
     *
     * @param string $slug
     * @return BlogEntity\Blog
     */
    public function buildFromSlug(
        string $slug
    ) : BlogEntity\Blog {
        return $this->buildFromArray(
            $this->blogTable->selectWhereSlug($slug)
        );
    }
}
