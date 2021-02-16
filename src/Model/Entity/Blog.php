<?php
namespace LeoGalleguillos\Blog\Model\Entity;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\User\Model\Entity as UserEntity;

class Blog
{
    protected $blogId;
    protected $created;
    protected $description;
    protected $name;
    protected $slug;

    /**
     * @var UserEntity\User
     */
    protected $user;

    protected $views;

    public function getBlogId() : int
    {
        return $this->blogId;
    }

    public function getCreated() : DateTime
    {
        return $this->created;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function getUser(): UserEntity\User
    {
        return $this->user;
    }

    public function getViews() : int
    {
        return $this->views;
    }

    public function setCreated(DateTime $created) : BlogEntity\Blog
    {
        $this->created = $created;
        return $this;
    }

    public function setDescription(string $description) : BlogEntity\Blog
    {
        $this->description = $description;
        return $this;
    }

    public function setSlug(string $slug) : BlogEntity\Blog
    {
        $this->slug = $slug;
        return $this;
    }

    public function setName(string $name) : BlogEntity\Blog
    {
        $this->name = $name;
        return $this;
    }

    public function setBlogId(int $blogId) : BlogEntity\Blog
    {
        $this->blogId = $blogId;
        return $this;
    }

    public function setUser(UserEntity\User $user) : BlogEntity\Blog
    {
        $this->user = $user;
        return $this;
    }

    public function setViews(int $views) : BlogEntity\Blog
    {
        $this->views = $views;
        return $this;
    }
}
