# Perch Redirects

Create 301/302 Redirects from within the Perch Admin.

_Note: This app currently only works with Perch Runway as it is required to load before handling every page. It will NOT work with the standard version of Perch._

## Installation

Copy the `morrison_redirects` folder into your Perch Installation directory under `/perch/addons/apps/morrison_redirects/`.

Add the app to the app config file under `/perch/config/apps.php`.

i.e.
```php
<?php
$apps_list = [
    'perch_forms',
    'morrison_redirects' // add this line
];
```

## Updating
After you download the new version of the app, delete the old application folder and copy in the new one.