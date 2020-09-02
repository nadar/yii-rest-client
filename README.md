# Yii Framework REST Client

A Yii Framework Component in order to work with LUYA headless REST Client

> Based on LUYA Headless Library which is similar to Yii Active Record but for any REST API.

## Installation


## Usage

Configure your API Client:

```php
'components' => [
    'api' => [
        'server' => 'https://myapi.com',
        'accessToken' => '...',
    ]
]
``` 

Now add your Rest Model (Active Endpoint):


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
$car->name;
$car->save(Yii::$app->api->client);
```