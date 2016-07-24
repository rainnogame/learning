#Шаблон для создания

*Можно использовать, например, для создание `RestController`*

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

Типы ответа и пояснение
![Картинка](https://github.com/rainnogame/TestScheduleCreator/raw/master/!examples/0.res/images/answer_types.png)
[Absolute Костомизация вывода результата `action` link](https://github.com/rainnogame/learning/blob/master/docs/какая-то%20херня%20на%20нашем/response/addCustomResponce.md)
*Дополнительно:*
- [ ] Создать `RestController` для примера
- [ ] Изучить исходники

