# Fruitdashboard API

## Installation

Include the FruitDashboard.php file into your project.

## Usage

Here's a code snippet of how you can use the API.

### Preparing the Data
```
$myData = array(
    'widgetId'          => your-widget-id,
    'date'              => 'yyyy-mm-dd',
    'my_first_dataset'  => 1,
    'my_second_dataset' => 2
);
```

### Instantiating the class
```
$fruitDashboard = new FruitDashboard('your-api-key', 'api-version');
$response = $fruitDashboard->post($myData);
```

### Handling response
```
    if ($response['status'] === FALSE) {
        // An error occurred.
        echo 'Something went wrong. This is what we know: ';
    }
    echo $response['message'];
```

That would be all of it.