<?php

namespace App\Entity;

use App\Entity\User;
use App\Helpers\EntityImage;

class News
{
    public int $id = 0;
    public string $title = '';
    public string $content = '';
    public ?string $img = null;
    public string $date = '';
    public ?User $user = null;
    public array $categories = [];

    public function __construct(int $id = 0)
    {
        if($id > 0) {
            $this->get($id);
        }
    }

    private function get(int $id)
    {
        $link = db_connect();
        $query = "
            SELECT n.id, n.title, n.content, n.img, n.date_create, n.user_id,
                   u.login, u.email
            FROM news n 
            LEFT JOIN users u ON u.id = n.user_id
            WHERE n.id = {$id}
        ";
        $res = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($res)) {
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->img = $row['img'];
            $this->date = $row['date_create'];
            $this->categories = $this->getCategories();
            if ($row['user_id'] > 0) {
                $user = new User();
                $user->id = $row['user_id'];
                $user->login = $row['login'];
                $user->email = $row['email'];
                $this->user = $user;
            }
        }
    }

    private function getCategories(): array
    {
        return Category::getListByNews($this);
    }

    public static function getList($limit = 0, $category_id = 0): array
    {
        $arItems = [];
        $link = db_connect();
        $query = "
            SELECT n.id, n.title, n.content, n.img, n.date_create, n.user_id,
                   u.login, u.email 
            FROM news n 
            LEFT JOIN users u ON u.id = n.user_id
            ORDER BY n.date_create DESC
        ";
        $query .= $limit > 0 ? "LIMIT " . $limit : '';
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $news = new self();
            $news->id = $row['id'];
            $news->title = $row['title'];
            $news->content = $row['content'];
            $news->img = $row['img'];
            $news->date = $row['date_create'];
//            $news->categories = $this->getCategories();
            if ($row['user_id'] > 0) {
                $user = new User();
                $user->id = $row['user_id'];
                $user->login = $row['login'];
                $user->email = $row['email'];
                $news->user = $user;
            }
            $arItems[] = $news;
        }
        return $arItems;
    }

    public function add(array $arCategoriesId = []): bool
    {
        $result = false;
        if ($this->id == 0) {
            $link = db_connect();
            $this->img = EntityImage::saveEntityImage('news', 'image');
            $query = "
                    INSERT INTO news
                    SET 
                        title = '{$this->title}', 
                        content = '{$this->content}', 
                        img = '{$this->img}', 
                        user_id = {$this->user->id}
            ";
            if (mysqli_query($link, $query)) {
                $this->id = mysqli_insert_id($link);
                $this->updateCategories($arCategoriesId);
                $result = true;
            } else {
                if (!empty($this->img)) {
                    EntityImage::deleteEntityImage('news', $this->img);
                }
            }
        }
        return (bool) $result;
    }

    public function delete(): bool
    {
        $result = false;
        if ($this->id > 0) {
            $link = db_connect();
            if (!empty($this->img)) {
                EntityImage::deleteEntityImage('news', $this->img);
            }
            $query = "DELETE FROM news WHERE id = {$this->id}";
            $result = mysqli_query($link, $query);
            if (mysqli_query($link, $query)) {
                $result = true;
            }

        }
        return (bool) $result;
    }

    public function update(array $arCategoriesId = []): bool
    {
        $result = false;
        if ($this->id > 0) {
            $link = db_connect();

            if($image = EntityImage::saveEntityImage('news', 'image')) {
                if(!empty($this->img)) {
                    EntityImage::deleteEntityImage('news', $this->img);
                }
                $this->img = $image;
            }
            $query = "
                    UPDATE news
                    SET
                        title = '{$this->title}', 
                        content = '{$this->content}', 
                        img = '{$this->img}',
                        user_id = {$this->user->id}                    
                    WHERE id = {$this->id}
            ";
            if (mysqli_query($link, $query)) {
                $this->updateCategories($arCategoriesId);
                $result = true;
            }
        }
        return (bool) $result;
    }

    private function updateCategories(array $arCategoriesId)
    {
        if ($this->id > 0 && !empty($arCategoriesId)) {
            $link = db_connect();
            $query = "DELETE FROM news_categories WHERE news_id = {$this->id}";
            mysqli_query($link, $query);

            $values = '';
            foreach ($arCategoriesId as $id) {
                $values .= $values != '' ? ',' : '';
                $values .= "({$this->id}, {$id})";
            }

            $query = "
                INSERT INTO news_categories (news_id, category_id)
                VALUES {$values}
            ";
            mysqli_query($link, $query);
        }
    }

}