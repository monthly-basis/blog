<?php
namespace LeoGalleguillos\Blog\Model\Service\Article;

use Exception;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\User\Model\Service as UserService;

class DoesVisitorOwnArticle
{
    public function __construct(
        UserService\LoggedInUser $loggedInUserService
    ) {
        $this->loggedInUserService = $loggedInUserService;
    }

    public function doesVisitorOwnArticle(BlogEntity\Article $articleEntity): bool
    {
        try {
            $userEntity = $this->loggedInUserService->getLoggedInUser();
        } catch (Exception $exception) {
            return false;
        }

        return ($userEntity->getUserId() == $articleEntity->getUserId());
    }
}
