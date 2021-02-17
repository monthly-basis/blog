<?php
namespace MonthlyBasis\Blog\Model\Entity;

use DateTime;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\User\Model\Entity as UserEntity;

class Article
{
    protected $articleId;
    protected $blogId;
    protected $body;
    protected $created;
    protected $title;
    protected $userId;
    protected $views;

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getBlogId(): int
    {
        return $this->blogId;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function setArticleId(int $articleId): BlogEntity\Article
    {
        $this->articleId = $articleId;
        return $this;
    }

    public function setBlogId(int $blogId): BlogEntity\Article
    {
        $this->blogId = $blogId;
        return $this;
    }

    public function setBody(string $body): BlogEntity\Article
    {
        $this->body = $body;
        return $this;
    }

    public function setCreated(DateTime $created): BlogEntity\Article
    {
        $this->created = $created;
        return $this;
    }

    public function setTitle(string $title): BlogEntity\Article
    {
        $this->title = $title;
        return $this;
    }

    public function setUserId(int $userId): BlogEntity\Article
    {
        $this->userId = $userId;
        return $this;
    }

    public function setViews(int $views): BlogEntity\Article
    {
        $this->views = $views;
        return $this;
    }
}
