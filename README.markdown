Overview
========

PHP Library for Product Recall API

http://search.usa.gov/api/recalls 

Usage
=====

<pre>
// Base API Class

require 'APIBaseClass.php';

require 'productRecallApi.php';

$new = new productRecallApi();
// examples from website documentation
// look up records within time range
$new->get_recall_data(NULL,'2010-01-01','2010-03-19');
// same with search query 'tires'
$new->get_recall_data('tires','2010-01-01','2010-03-19');
// look up upc

//http://search.usa.gov/search/recalls?start_date=2010-01-01&end_date=2010-03-19&format=json 
$new->

// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));

</pre>
