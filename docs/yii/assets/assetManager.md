#Обзор `AssetManager`

**AssetBundle**

Стандартный `AssetBundle`
```php
class YiiAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
```

`AssetBundle` представляет коллекцию ресурсов. Может зависить от другиг `AssetBundle`, в этом случае все ресурсы наслудуются.

|`$sourcePath`| 123|
_____________________________________
|`$basePath` |123 |
_____________________________________
|`$baseUrl` | 123|
_____________________________________
|`$depends` |123 |
_____________________________________
|`$js` |123 |
_____________________________________
|`$css` | 123|
_____________________________________
|`$jsOptions` | 123|
_____________________________________
|`$cssOptions` | 123|
_____________________________________
|`$publishOptions` | 123|
_____________________________________