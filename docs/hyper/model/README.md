# Model

> Model为数据表的对象映射.

1. 文件位置: `app/Model`
2. 命名空间: `App\Model`
3. 命名规则: `大驼峰` - 例如: `app/Controllers/Example.php`

```shell
php bin/hyperf.php gen:model Registry \
  --with-comments \
  --property-case=1
```

*说明*

1. 每张表必须固定具有下列字段.
    1. `id` - 表示主键.
    2. `created_at` - 记录创建时间, 与业务无关.
    3. `updated_at` - 最后修改时间, 与业务无法, 只要记录变更过(不论何处)则更新为变更时间.
2. 命名规范
    1. 在数据表中使用 `蛇形` (`下划线`), 例如: `user_id`
    2. 在Model类中使用 `小驼峰`, 例如: `userId`.

```text
CREATE TABLE IF NOT EXISTS `example`(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',

    --
    -- 省略
    --

    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',

    PRIMARY KEY (`id`)
) -- 省略
```
