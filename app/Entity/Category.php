<?php

namespace App\Entity;

class Category
{
    public int $id = 0;
    public string $title = '';
    public string $description = '';
    public ?int $parent_id = null;
    public int $level = 0;
    public array $children = [];

    public function __construct(int $id = 0)
    {
        if($id > 0) {
            $this->get($id);
        }
    }

    private function get(int $id)
    {
        $link = db_connect();
        $query = "SELECT id, title, description, parent_id FROM categories WHERE id = {$id}";
        $res = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($res)) {
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->parent_id = $row['parent_id'];
        }
    }

    public static function getList(): array
    {
        $arItems = [];
        $link = db_connect();
        $query = "SELECT id, title, description, parent_id FROM categories ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $category = new self();
            $category->id = $row['id'];
            $category->title = $row['title'];
            $category->description = $row['description'];
            $category->parent_id = $row['parent_id'];
            $arItems[] = $category;
        }
        return $arItems;
    }

    public static function getListByNews(News $news): array
    {
        $arItems = [];
        if ($news->id > 0) {
            $link = db_connect();
            $query = "
                SELECT c.id, c.title, c.description, c.parent_id 
                FROM news_categories nc
                LEFT JOIN categories c ON nc.category_id = c.id
                WHERE nc.news_id = {$news->id}
                ORDER BY c.id
            ";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $category = new self();
                $category->id = $row['id'];
                $category->title = $row['title'];
                $category->description = $row['description'];
                $category->parent_id = $row['parent_id'];
                $arItems[] = $category;
            }
        }
        return $arItems;
    }

    public function add(): bool
    {
        $result = false;
        if ($this->id == 0) {
            $link = db_connect();
            $query = "
                    INSERT INTO categories
                    SET title = '{$this->title}', 
                    description = '{$this->description}', 
                    parent_id = " . ($this->parent_id > 0 ? $this->parent_id : 'NULL') . "
            ";
            $result = mysqli_query($link, $query);
        }
        return (bool) $result;
    }

    public function delete(): bool
    {
        $result = false;
        if ($this->id > 0) {
            $link = db_connect();
            $query = "DELETE FROM categories WHERE id = {$this->id}";
            $result = mysqli_query($link, $query);
        }
        return (bool) $result;
    }

    public function update(): bool
    {
        $result = false;
        if ($this->id > 0) {
            $link = db_connect();
            $query = "
                    UPDATE categories
                    SET title = '{$this->title}', 
                        description = '{$this->description}', 
                        parent_id = " . ($this->parent_id > 0 ? $this->parent_id : 'NULL') . "
                    WHERE id = {$this->id}
            ";
            $result = mysqli_query($link, $query);
        }
        return (bool) $result;
    }

    public static function getTree($parent_id = 0, $max_level = 0, $current_level = 0) {
        $arResult = [];
        foreach(self::getList() as $category) {
            if($parent_id == $category->parent_id) {
                $arResult[$category->id] = $category;
                if($max_level == 0 || $max_level > $current_level) {
                    $arResult[$category->id]->children = self::getTree($category->id, $max_level, $current_level + 1);
                }
            }
        }
        return $arResult;
    }

    public static function getListStructured($parent_id = 0, $max_level = 0, $current_level = 0): array
    {
        $arResult = [];
        foreach(self::getList() as $category) {
            if($parent_id == $category->parent_id) {
                $arResult[$category->id] = $category;
                $arResult[$category->id]->level = $current_level;
                if($max_level == 0 || $max_level > $current_level) {
                    $arResult = array_merge($arResult, self::getListStructured($category->id, $max_level, $current_level + 1));
                }
            }
        }
        return $arResult;
    }
}