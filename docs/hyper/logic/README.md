# Logic

> 实际业务的执行逻辑.

1. 文件位置: `app/Logic`
2. 命名空间: `App\Logic`
3. 命名规则: `大驼峰` `Logic结尾` - 例如: `app/Logic/ExampleLogic.php`

```
use GuanbangHyperf\Logic\Logic;
use GuanbangHyperf\Logic\Logic;

class ExampleLogic extends Logic
{
    #[Inject]
    public ExampleService $exampleService;

     /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function run(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        $model = $this->exampleService->getById(1);
        
        if ($model === null){
            return $response->raw("not found");
        }
    
        return $response->raw("found");
    }
}
```

### 标准返回.

##### 一、基础数据.

> 用法 `.withData(ResponseInterface $response, array|Arrayable|Jsonable $data)`

```php
 class ExampleLogic extends Logic
 {
     /**
      * @param RequestInterface $request
      * @param ResponseInterface $response
      * @return \Psr\Http\Message\ResponseInterface
      */
     public function run(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
     {
         return $this->withData($response, ['key' => 'value']);
     }
 }
 ```

结果

```json
{
  "errno": 0,
  "error": "",
  "data": {
    "key": "value"
  }
}
```

1. 返回错误.
1. 返回列表.
1. 返回分页.
1. 返回文本.
