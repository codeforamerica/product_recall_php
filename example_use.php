<?php
// Base API Class
require 'APIBaseClass.php';

require 'productRecallApi.php';

$new = new productRecallApi();

// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));
