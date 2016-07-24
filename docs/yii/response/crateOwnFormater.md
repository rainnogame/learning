#Создание собственного форматировщика

*Можно использовать, например, для создание `RestController`*

*Создание:*
```php
namespace app\utilities;

use Symfony\Component\Yaml\Yaml;
use yii\web\Response;
use yii\web\ResponseFormatterInterface;

class YamlFormatter implements ResponseFormatterInterface
{

    const FORMAT = 'yaml';

    /**
     * Formats the specified response.
     * @param Response $response the response to be formatted.
     */
    public function format($response)
    {
//        $response->headers->set('Content-Type: application/yaml'); // Если устанавливать, то контент скачивается
//        $response->headers->set('Content-Disposition: inline'); // Аналогично
        $response->content = Yaml::dump($response->data);
    }
}
```

*Применение: ([Использование стандартных форматировщиков](/addCustomResponse.md))*
```php
public function actionTest()
{
    $some_data = ['a' => '123', 'b' => ['c' => '123', 'd' => '1234231']];
    $response = \Yii::$app->response; 
    $response->format = YamlFormatter::FORMAT;
    $response->data = $some_data; 
    return $response; 
}
```


*Дополнительно:*
- [ ] Разобраться с headers
- [ ] Изучить исходники

