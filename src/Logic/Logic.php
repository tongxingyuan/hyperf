<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Tongxingyuan\Hyperf\Logic;

use Hyperf\Contract\Arrayable;
use Hyperf\Contract\Jsonable;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class Logic
{
    public const LoggerCategory = 'request';

    #[Inject]
    protected ContainerInterface $container;

    /**
     * 日志接口.
     */
    protected LoggerInterface $logger;

    /**
     * 日志工厂.
     */
    protected LoggerFactory $loggerFactory;

    /**
     * 逻辑工厂.
     * @throws \Throwable
     */
    public static function factory(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        $logic = new static();
        $logic->initialize();

        return $logic->run($request, $response);
    }

    /**
     * 初始化.
     *
     * @throws \Throwable
     */
    public function initialize(): void
    {
        $this->loggerFactory = $this->container->get(LoggerFactory::class);
        $this->logger = $this->loggerFactory->get(self::LoggerCategory);
    }

    /**
     * 执行过程.
     */
    abstract public function run(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface;


    /**
     * 返回错误.
     *
     * @param ResponseInterface $response
     * @param array|Arrayable|Jsonable $data
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @example return $this->withError($response, 403, 'Forbidden')
     *
     * @example return {
     *      'errno' => 403,
     *      'error' => 'Forbidden',
     *      'data' => {},
     *      'dataType' => 'OBJECT',
     * }
     */
    protected function withData(ResponseInterface $response, $data): \Psr\Http\Message\ResponseInterface
    {
        return $response->json([
            'errno' => 0,
            'error' => '',
            'data' => $data,
            'dataType' => 'OBJECT',
        ]);
    }

    /**
     * 返回错误.
     *
     * @param ResponseInterface $response
     * @param int $errno
     * @param string $error
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @example return $this->withError($response, 403, 'Forbidden')
     *
     * @example return {
     *      'errno' => 403,
     *      'error' => 'Forbidden',
     *      'data' => {},
     *      'dataType' => 'ERROR',
     * }
     */
    protected function withError(ResponseInterface $response, int $errno, string $error): \Psr\Http\Message\ResponseInterface
    {
        return $response->json([
            'errno' => $errno,
            'error' => $error,
            'data' => (object)[],
            'dataType' => 'ERROR'
        ]);
    }

    /**
     * 返回列表.
     *
     * @param ResponseInterface $response
     * @param array|Arrayable|Jsonable $data
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @example return $this->withList($response, [
     *      ['id' => 1],
     *      ['id' => 2],
     * ])
     *
     * @example return {
     *      'errno' => 0,
     *      'error' => '',
     *      'data' => [
     *          {
     *              'id' => 1
     *          },
     *          {
     *              'id' => 2
     *          }
     *      ]
     *      'dataType' => 'LIST',
     * }
     */
    protected function withList(ResponseInterface $response, $data): \Psr\Http\Message\ResponseInterface
    {
        return $response->json([
            'errno' => 0,
            'error' => '',
            'data' => $data,
            'dataType' => 'LIST'
        ]);
    }

    /**
     * 返回分页.
     *
     * @param ResponseInterface $response
     * @param $paginator
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @example return {
     *      'errno' => 0,
     *      'error' => '',
     *      'data' => [
     *          'body' => [
     *              {
     *                  'id' => 1
     *              },
     *              {
     *                  'id' => 2
     *              }
     *          ],
     *          'paging' => {
     *          }
     *      ]
     *      'dataType' => 'PAGING',
     * }
     */
    protected function withPaging(ResponseInterface $response, \Hyperf\Paginator\LengthAwarePaginator $paginator): \Psr\Http\Message\ResponseInterface
    {

    }


    /**
     * 返回字符串.
     *
     * @param ResponseInterface $response
     * @param string $str
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function withString(ResponseInterface $response, string $str): \Psr\Http\Message\ResponseInterface
    {
        return $response->raw($str);
    }
}
