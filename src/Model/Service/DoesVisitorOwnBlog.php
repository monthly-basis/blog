<?php
namespace LeoGalleguillos\Blog\Model\Service;

use Exception;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\User\Model\Service as UserService;

class DoesVisitorOwnBlog
{
    public function __construct(
        UserService\LoggedInUser $loggedInUserService
    ) {
        $this->loggedInUserService = $loggedInUserService;
    }

    public function doesVisitorOwnBlog(BlogEntity\Blog $blogEntity): bool
    {
        try {
            $userEntity = $this->loggedInUserService->getLoggedInUser();
        } catch (Exception $exception) {
            return false;
        }

        return ($userEntity->getUserId() == $blogEntity->getUserEntity()->getUserId());
    }
}
