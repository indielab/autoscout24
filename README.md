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
    $car->getTypeNameFull();
}
```

In order to generate a response without pagination use:

```php
$query->findAll();
```
