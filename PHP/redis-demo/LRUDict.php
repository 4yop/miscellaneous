<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

class LRUDict
{
    protected $capacity;
    protected $items = [];

    public function __construct ($capacity)
    {
        $this->capacity = $capacity;
    }

    public function setItem(string $key,$value)
    {
        if ( isset($this->items[$key]) )
        {
            unset($this->items[$key]);
            $this->items[$key] = $value;
        }elseif (count($this->items) < $this->capacity )
        {
            $this->items[$key] = $value;
        }else
        {
            //最近没用过的，都在前面
            reset($this->items);
            $first_key = key($this->items);
            unset($this->items[$first_key]);

            $this->items[$key] = $value;
        }
    }

    public function getItem(string $key)
    {
        if (!isset($this->items[$key]))
        {
            return false;
        }
        $value = $this->items[$key];

        //用过了，放后面
        unset($this->items[$key]);
        $this->items[$key] = $value;

        return $value;
    }

    public function __toString()
    {
        return json_encode($this->items);
    }
}

$d = new LRUDict(10);

foreach (range(1,15) as $i)
{
    $d->setItem($i,$i);
}

echo $d;