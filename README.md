> DANGER: The AutoScout24 Endpoint is only available if they whiteliste your provided IP Address, this makes it very hard to develop local - as you can imagine. An incredible bad solution for such a big company, just saying. Maybe try to use another car sharing platform which provides a more modern technology approach!

# AutoScout24 PHP REST API CLIENT

[![Latest Stable Version](https://poser.pugx.org/indielab/autoscout24/v/stable)](https://packagist.org/packages/indielab/autoscout24)
[![Total Downloads](https://poser.pugx.org/indielab/autoscout24/downloads)](https://packagist.org/packages/indielab/autoscout24)
[![License](https://poser.pugx.org/indielab/autoscout24/license)](https://packagist.org/packages/indielab/autoscout24)

A very easy to use library to work with the AutoScout24 REST Api.

## Examples

Before using the library you have to obtain your *cuid* and *memberid* from the AutoScout24 Support.

### Getting Data

```php
// setup client object
$client = new Client($cuid, $memberId);

// generate query object
$query = new VehicleQuery();
$query->setClient($client);
foreach ($cars->find() as $car) {
    $car->getTypeNameFull();
}
```

The above code is equal with the following short notation:

```php
$client = new Client($cuid, $memberId);
$cars = (new VehicleQuery())->setClient($client)->find();
foreach ($cars as $car) {
    $car->getId();
}
```

In order to generate a response without pagination use:

```php
$client = new Client($cuid, $memberId);
$cars = (new VehicleQuery())->setClient($client)->findAll();
```

Find a car by its id:

```php
$client = new Client($cuid, $memberId);
$car = (new VehicleQuery())->setClient($client)->findOne($carId);
```

Filter and Sorting:

```php
$client = new Client($cuid, $memberId);
$cars = (new VehicleQuery())->setClient($client)->setVehicleSorting('price_desc')->find();
```

See the VehiceQuery class for all filter and sorting methods like: 

+ setVehicleSorting()
+ setVehicleTypeId()
+ setYearTo()
+ setEquipment()
+ setPage()
+ setItemsPerPage()
+ setMake()
+ setModel()

### Meta Data

```php
$client = new Clien($cuid, $memberId);
$data = (new MetaQuery())->setClient($client)->findPkw();

foreach ($data as $meta) {
    var_dump($meta->getParameterName(), $meta->getDescription());
}
```

filter by a type

```php
$meta = (new MetaQuery())->setClient($this->client)->findPkw()->filter('sort');
```
