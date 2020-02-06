<?php

namespace common\resource;

use phpDocumentor\Reflection\Types\Integer;
use yii\db\ActiveRecord;
use common\models\AppleDb;


class Apple
{

    public $id;
    public $status;
    public $color;
    public $size;
    public $date_fall;
    public $date_create;

    const APPLE_SIZE = 1;

    public function __construct($color)
    {
        $this->color = $color;
        $this->size = self::APPLE_SIZE;
        $this->date_create = time();
        $this->status = 0;
    }

    public function fallToGround()
    {
        $this->status = 1;
        $this->date_fall = time();
    }

    public function eat($size)
    {
        if ($this->status == 0) {
            throw new \Exception('Съесть нельзя, яблоко на дереве');
        }
        if ($size > $this->size) {
            $this->size = 0;
        } else {
            $this->size -= $size;
        }

    }

    public function isLife()
    {
        return $this->size > 0;
    }

    public function getStateText()
    {
        if ($this->status) {
            return 'На земле';
        }
        return 'На дереве';
    }
}