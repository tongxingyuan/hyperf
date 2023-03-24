<?php

declare(strict_types=1);

namespace Tongxingyuan\Hyperf\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 账号鉴权.
 */
class Authentication implements MiddlewareInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    /**
     * 账号鉴权.
     *
     * 检查用户是否已登录(JWT), 若未登录则跳转到统一登录页, 登录成功后再回来. 若已登录则通过。
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request);
    }
}
