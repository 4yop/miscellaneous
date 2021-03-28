<?php


namespace designPattern\Iterator;


class IteratorTest
{
    public function __construct()
    {
        echo "\n迭代器模式\n";
        $book = new Book("鲁迅","少年闰土");

        echo $book->getAuthor()."\n";
        echo $book->getTitle()."\n";
        echo $book->getAuthorAndTitle()."\n";
    }
}