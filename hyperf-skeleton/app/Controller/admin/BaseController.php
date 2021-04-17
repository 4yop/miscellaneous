<?php


namespace App\Controller\admin;
use function Hyperf\ViewEngine\view;

class BaseController extends AbstractController
{
    public function view($view = null, $data = [], $mergeData = [])
    {
        $view = "admin/{$view}";
        return (string) view($view,$data = [], $mergeData = []);
    }
}