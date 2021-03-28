<?php
namespace designPattern\Iterator;


//迭代器模式
//作用:让对象变得可迭代并表现得像对象集合。
class Book
{
    /**
     * @var string
     */
    private $title;
    private $author;

    public function __construct(string $author,string $title)
    {
        $this->title = $title;
        $this->author = $author;
    }

    public function getAuthor():string
    {
        return $this->author;
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function getAuthorAndTitle():string
    {
        return "title:{$this->title},author:{$this->author}";
    }

}