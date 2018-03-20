<?php
namespace LeoGalleguillos\Blog\Model\Factory;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Table as BlogTable;

class Blog
{
    /**
     * Construct
     *
     * @param BlogTable\Blog $blogTable
     */
    public function __construct(
        BlogTable\Blog $blogTable
    ) {
        $this->blogTable = $blogTable;
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
