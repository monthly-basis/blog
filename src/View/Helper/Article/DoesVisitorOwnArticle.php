<?php
namespace MonthlyBasis\Blog\View\Helper\Article;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Service as BlogService;
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
