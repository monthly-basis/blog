<?php
namespace LeoGalleguillos\Blog\Model\Table;

use Generator;
use Zend\Db\Adapter\Adapter;

class Blog
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function insert(
        int $userId,
        string $name,
        string $slug,
        string $description
    ) {
        $sql = '
            INSERT
              INTO `blog` (
                       `user_id`, `name`, `slug`, `description`, `created`
                   )
            VALUES (?, ?, ?, ?, UTC_TIMESTAMP())
                 ;
        ';
        $parameters = [
            $userId,
            $name,
            $slug,
            $description
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function selectCount()
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `blog`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    public function selectCountWhereUserId(int $userId)
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `blog`
             WHERE `blog`.`user_id` = :userId
                 ;
        ';
        $parameters = [
            'userId' => $userId,
        ];
        $row = $this->adapter->query($sql)->execute($parameters)->current();
        return (int) $row['count'];
    }

    public function selectOrderByCreatedDesc() : Generator
    {
        $sql = '
            SELECT `blog_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `views`
                 , `created`
              FROM `blog`
             ORDER
                BY `created` DESC
             LIMIT 100
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $row) {
            yield($row);
        }
    }

    public function selectWhereBlogId(int $blogId) : array
    {
        $sql = '
            SELECT `blog_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `views`
                 , `created`
              FROM `blog`
             WHERE `blog_id` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$blogId])->current();
    }

    public function selectWhereSlug(string $slug) : array
    {
        $sql = '
            SELECT `blog_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `views`
                 , `created`
              FROM `blog`
             WHERE `slug` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$slug])->current();
    }

    public function selectWhereUserId(int $userId) : Generator
    {
        $sql = '
            SELECT `blog_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `views`
                 , `created`
              FROM `blog`
             WHERE `user_id` = :userId
             ORDER
                BY `blog`.`name` ASC
                 ;
        ';
        $parameters = [
            'userId' => $userId,
        ];
        foreach ($this->adapter->query($sql)->execute($parameters) as $array) {
            yield $array;
        }
    }

    public function updateViewsWhereBlogId(int $blogId) : bool
    {
        $sql = '
            UPDATE `blog`
               SET `blog`.`views` = `blog`.`views` + 1
             WHERE `blog`.`blog_id` = ?
                 ;
        ';
        $parameters = [
            $blogId
        ];
        return (bool) $this->adapter->query($sql)->execute($parameters)->getAffectedRows();
    }

    public function updateWhereUserId(ArrayObject $arrayObject, int $userId) : bool
    {
        $sql = '
            UPDATE `user`
               SET `user`.`welcome_message` = ?
             WHERE `user`.`user_id` = ?
                 ;
        ';
        $parameters = [
            $arrayObject['welcome_message'],
            $userId
        ];
        return (bool) $this->adapter->query($sql, $parameters)->getAffectedRows();
    }
}
