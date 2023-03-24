<?php

namespace Tongxingyuna\Hyperf\Model;

/**
 * 示例模型.
 *
 * 可通过 `php bin/hyperf.php gen:model Example --with-comments` 命令自动生成.
 *
 * @property int $id
 * @property int $status
 * @property string $title
 * @property string $gmt_created
 * @property string $gmt_updated
 */
class Example extends Model
{
    /**
     * 表名.
     */
    protected ?string $table = 'example';

    protected array $fillable = [];

    /**
     * 类型转换.
     */
    protected array $casts = [
        'id' => 'integer',
        'status' => 'integer'
    ];
}