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
        string $description,
        string $website
    ) {
        $sql = '
            INSERT
              INTO `business` (
                       `user_id`, `name`, `slug`, `description`, `website`, `created`
                   )
            VALUES (?, ?, ?, ?, ?, UTC_TIMESTAMP())
                 ;
        ';
        $parameters = [
            $userId,
            $name,
            $slug,
            $description,
            $website
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function isUsernameInTable($username)
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `user`
             WHERE `username` = ?
                 ;
        ';
        $row = $this->adapter->query($sql, [$username])->current();
        return (bool) $row['count'];
    }

    public function selectCount()
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `business`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    public function selectCountWhereUserId(int $userId)
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `business`
             WHERE `business`.`user_id` = :userId
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
            SELECT `business_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `website`
                 , `views`
                 , `created`
              FROM `business`
             ORDER
                BY `created` DESC
             LIMIT 100
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $row) {
            yield($row);
        }
    }

    public function selectWhereBlogId(int $businessId) : array
    {
        $sql = '
            SELECT `business_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `website`
                 , `views`
                 , `created`
              FROM `business`
             WHERE `business_id` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$businessId])->current();
    }

    public function selectWhereSlug(string $slug) : array
    {
        $sql = '
            SELECT `business_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `website`
                 , `views`
                 , `created`
              FROM `business`
             WHERE `slug` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$slug])->current();
    }

    public function selectWhereUserId(int $userId) : Generator
    {
        $sql = '
            SELECT `business_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `website`
                 , `views`
                 , `created`
              FROM `business`
             WHERE `user_id` = :userId
             ORDER
                BY `business`.`name` ASC
                 ;
        ';
        $parameters = [
            'userId' => $userId,
        ];
        foreach ($this->adapter->query($sql)->execute($parameters) as $array) {
            yield $array;
        }
    }

    public function updateViewsWhereUserId(int $userId) : bool
    {
        $sql = '
            UPDATE `user`
               SET `user`.`views` = `user`.`views` + 1
             WHERE `user`.`user_id` = ?
                 ;
        ';
        $parameters = [
            $userId
        ];
        return (bool) $this->adapter->query($sql, $parameters)->getAffectedRows();
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
