<?php
declare(strict_types=1);

namespace App\Controller;
use App\Service\UserService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Di\Annotation\Inject;
use function Hyperf\ViewEngine\view;
/**
 * @AutoController()
 */
class TestController
{
    /**自动注入
    * @Inject()
    * @var UserService
     */
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Hyperf 会自动为此方法生成一个 /index/index 的路由，允许通过 GET 或 POST 方式请求
    /**
     * @RequestMapping(path="t/index", methods="get,post")
     */
    public function index(RequestInterface $request)
    {
        $id = $request->input('id',1);
        return $this->userService->getInfoById($id);
    }

    public function view1()
    {
        return (string) view('index',['name'=>'hyperf']);
    }

}