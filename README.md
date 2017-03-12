# AutoScout24 PHP REST API CLIENT

A very easy to use library to work with the AutoScout24 REST Api.

## Examples

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
$client = new Clien($cuid, $memberId);
$cars = (new VehicleQuery())->setClient($client)->find();
foreach ($cars as $car) {
    $car->getId();
}
```

In order to generate a response without pagination use:

```php
$client = new Clien($cuid, $memberId);
$cars = (new VehicleQuery())->setClient($client)->findAll();
```

Find a car by its id:

```php
$client = new Client($cuid, $memberId);
$car = (new VehicleQuery())->setClient($client)->findOne($carId);
```

Filter and Sorting:

```php
$client = new Clien($cuid, $memberId);
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