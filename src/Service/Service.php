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

namespace Tongxingyuna\Hyperf\Service;

use Hyperf\Database\Model\Collection;
use Hyperf\DbConnection\Model\Model as BaseModel;

/**
 * 服务基类.
 */
abstract class Service
{
    protected function getModel(string $model, array|\Closure|string $conditions): mixed
    {
        if (is_subclass_of($model, BaseModel::class)) {
            $res = $model::query()->where($conditions)->limit(1)->get();
            if (($res instanceof Collection) && count($res) > 0) {
                return $res[0];
            }

            if ($res instanceof BaseModel) {
                return $res;
            }
        }

        return null;
    }

    protected function listModel(string $model, array|\Closure|string $conditions): mixed
    {
        if (is_subclass_of($model, BaseModel::class)) {
            $res = $model::query()->where($conditions)->get();
            if ($res instanceof Collection) {
                return $res;
            }
        }

        return null;
    }

    protected function pagingModel(string $model, int $perPage, array|\Closure|string $conditions): \Hyperf\Paginator\LengthAwarePaginator|null
    {
        if (is_subclass_of($model, BaseModel::class)) {
            return $model::query()->where($conditions)->paginate($perPage);
        }
        return null;
    }

    protected function insertModel(string $model, array $values): mixed
    {
        if (is_subclass_of($model, BaseModel::class)) {
            $builder = $model::query();
            $id = $builder->insertGetId($values);

            if ($id > 0) {
                return $this->getModel($model, [
                    'id' => $id,
                ]);
            }
        }

        return null;
    }
}
