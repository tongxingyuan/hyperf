<?php

namespace Tongxingyuna\Hyperf\Model;


use Hyperf\DbConnection\Model\Model as BaseModel;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

/**
 * 模型基类.
 */
abstract class Model extends BaseModel implements CacheableInterface
{
    use Cacheable;
}
