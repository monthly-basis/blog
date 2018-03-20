<?php
namespace LeoGalleguillos\Blog\Model\Service\Blog;

use Exception;
use LeoGalleguillos\Flash\Model\Service as FlashService;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\User\Model\Entity as UserEntity;

class Create
{
    public function __construct(
        FlashService\Flash $flashService,
        BlogFactory\Blog $blogFactory,
        BlogTable\Blog $blogTable
    ) {
        $this->flashService    = $flashService;
        $this->blogFactory = $blogFactory;
        $this->blogTable   = $blogTable;
    }

    /**
     * Create.
     *
     * @param $userId
     * @return BlogEntity\Blog
     */
    public function create(
        UserEntity\User $userEntity = null
    ) : BlogEntity\Blog {
        $errors = [];

        if (empty($_POST['name'])) {
            $errors[] = 'Invalid name.';
        }
        if (empty($_POST['description'])) {
            $errors[] = 'Invalid description.';
        }

        if ($errors) {
            $this->flashService->set('errors', $errors);
            throw new Exception('Invalid form input.');
        }

        $blogId = $this->blogTable->insert(
            $userEntity->getUserId(),
            $_POST['subject'],
            $_POST['message']
        );

        return $this->blogFactory->buildFromBlogId($blogId);
    }
}
