#Костомизация вывода результата `action`

Можно использовать, например, для создание `RestController`

```php
  public function actionAdd()
    {
        $some_data = $this->getSomeData(); // 1
        $response = \Yii::$app->response; // 2 
        $response->format = Response::FORMAT_RAW; // 3 
        $response->data = $some_data; // 4
        return $response; // 5
    }
```
> 1. Получаем данные
> 2. Берем компонент
> 3. Устанавливаем форматирование
> 4. Устанавливаем дату
> 5. Отправляем ко всем ебеням

Создание:
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

Применение:
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
```php
components' => [
        'response' => [
            'formatters' => [
                'yaml' => [
                    'class' => 'app\utilities\YamlFormatter'
                ]
            ]
        ],
```

Типы ответа и пояснение
![Картинка](https://github.com/rainnogame/TestScheduleCreator/raw/master/!examples/0.res/images/answer_types.png)

*Дополнительно:*
- [ ] Создать `RestController` для примера
- [ ] Изучить исходники
- [ ] Разобраться с headers
- [ ] Изучить исходники
- [ ] Подумать, как еще использовать

