# AutoScout24 PHP REST API CLIENT

A very easy to use library to work with the AutoScout24 REST Api.

## Examples

```php
// setup client object
$client = new Client('1234', '1234');

// generate query object
$query = new VehicleQuery();
$query->setClient($client);
foreach ($cars->find() as $car) {
    $car->getName();
}
```

An example with where parameters:

```php
$client = new Client('1234', '1234');

$cars = new Vehicles();
$cars->setClient($client);
foreach ($cars->where(['this' => 'that'])->find() as $car) {
    $car->getName();
}
``
