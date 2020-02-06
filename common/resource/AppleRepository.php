<?php

namespace common\resource;

use common\models\AppleDb;

class AppleRepository
{
    protected $repo;

    public function __construct(AppleDb $repo)
    {
        $this->repo = $repo;
    }

    public function setItem(Apple $apple)
    {
        if (!empty($apple->id)) {
            $model = $this->repo->findOne($apple->id);
        }

        if (!$model) {
            $model = new AppleDb();
        }

        $model->setAttributes((array)$apple);
        $model->save(false);
    }

    public function getItem($id)
    {
        $apple = $this->repo->findOne($id);
        if (!$apple) {
            throw new \Exception('Яблоко не найдено');
        }
        $apple = $this->convertItemDbToItem($apple);
        return $apple;
    }

    public function findAllItems()
    {
        $apples = [];
        if ($applesDb = $this->repo->findAll([])) {
            foreach ($applesDb as $item) {
                $apples[] = $this->convertItemDbToItem($item);
            }
        }
        return $apples;
    }

    public function deleteItem($id)
    {
        $item = $this->repo->findOne($id);
        if (!$item) {
            throw new \Exception('Элемент не найден');
        }
        $item->delete();
    }

    protected function convertItemDbToItem(AppleDb $appleDb)
    {
        $apple = new Apple($appleDb->color);
        $apple->id = $appleDb->id;
        $apple->size = $appleDb->size;
        $apple->status = $appleDb->status;
        $apple->date_create = $appleDb->date_create;
        $apple->date_fall = $appleDb->date_fall;
        return $apple;
    }

}