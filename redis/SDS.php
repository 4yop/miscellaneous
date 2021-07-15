<?php


class Sdshdr
{
    public int $free = 0; // buf[]数组未使用字节的数量

    public int $len = 0; // buf[]数组所保存的字符串的长度

    public array $buf = []; // 保存字符串的数组
}