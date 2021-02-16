<?php
namespace LeoGalleguillos\Blog\View\Helper\Article;

use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use Laminas\View\Helper\AbstractHelper;

class DoesVisitorOwnArticle extends AbstractHelper
{
    public function __construct(
        BlogService\Article\DoesVisitorOwnArticle $doesVisitorOwnArticleService
    ) {
        $this->doesVisitorOwnArticleService = $doesVisitorOwnArticleService;
    }

    public function __invoke(BlogEntity\Article $articleEntity)
    {
        return $this->doesVisitorOwnArticleService->doesVisitorOwnArticle(
            $articleEntity
        );
    }
}
