# Yii Framework REST Client

A Yii Framework Component in order to work with the LUYA headless REST Client. The LUYA REST Client is an Active Record similar solution for APIs.

It works with Yii Framework out of the box, therefore those things are included:

+ Use `fields` in your requests
+ Use `sort` in your requests
+ Working with `expand`
+ Caching
+ CRUD (Create new records, Read records, Update records, Delete records) API operations
+ Similar to Yii Framework Active Query and Active Record

![Tests](https://github.com/nadar/yii-rest-client/workflows/Tests/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/8c712b4f0d9dde1f0383/maintainability)](https://codeclimate.com/github/nadar/yii-rest-client/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/8c712b4f0d9dde1f0383/test_coverage)](https://codeclimate.com/github/nadar/yii-rest-client/test_coverage)

## Installation

Installation via composer

```sh
composer require nadar/yii-rest-client
```

## Usage & Dokumentation

Configure your API Client:

```php
'components' => [
    'api' => [
        'class' => 'Nadar\YiiRestClient\Api',
        'server' => 'https://myapi.com',
        'accessToken' => '...',
    ]
]
``` 

> **To see all LUYA Headless functions see the [LUYA Headless Documentation](https://github.com/luyadev/luya-headless)**

Now add your Rest Model (Active Endpoint), this represents the Model on the client side. It provides basic getter and setter methods same as Yii Framework.


```php
class ApiCars extends \luya\headless\ActiveEdnpoint
{
    public $id;
    public $name;
    public $year;

    public function getEndpointName()
    {
        return '{{%cars}}';
    }
}
```

The above example assumes the full endpoint is `https://myapi.com/cars`.

Working with the Model to make CRUD operations like list, edit, save.

Foreach Data (Will make a GET request):

```php
foreach (ApiCars::find()->all(Yii::$app->api->client)->getModels() as $car) {

    var_dump($car->name);
}
```

View One and Update the record (Will make a PUT request):

```php
$car = ApiCars::viewOne(1, Yii::$app->api->client);
echo $car->name; // f.e BMW
$car->name = 'Mercedes';
$car->save(Yii::$app->api->client);
``` 

Add new entry (will make a POST request):

```php
$car = new ApiCars();
$car->name = 'Honda';
$car->save(Yii::$app->api->client);
```

> **To see all LUYA Headless functions see the [LUYA Headless Documentation](https://github.com/luyadev/luya-headless)**
