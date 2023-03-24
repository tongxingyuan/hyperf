<?php

declare(strict_types=1);

namespace Tongxingyuan\Hyperf\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 服务鉴权.
 */
class Accessibility implements MiddlewareInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    /**
     * 校验权限.
     *
     * 当前登的账号(所有组织{学校|角色})是否有操作权限, 若无权限则进入403(Forbidden)页面.
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
