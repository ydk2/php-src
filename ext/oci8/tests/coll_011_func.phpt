--TEST--
collections and strings
--SKIPIF--
<?php
$target_dbs = array('oracledb' => true, 'timesten' => false);  // test runs on these DBs
require(dirname(__FILE__).'/skipif.inc');
?> 
--FILE--
<?php

require dirname(__FILE__)."/connect.inc";

$ora_sql = "DROP TYPE
						".$type_name."
		   ";

$statement = OCIParse($c,$ora_sql);
@OCIExecute($statement);

$ora_sql = "CREATE TYPE ".$type_name." AS TABLE OF VARCHAR(10)";
			  
$statement = OCIParse($c,$ora_sql);
OCIExecute($statement);


$coll1 = ocinewcollection($c, $type_name);
$coll2 = ocinewcollection($c, $type_name);

var_dump(oci_collection_append($coll1, "string"));
var_dump(oci_collection_append($coll1, "string"));

var_dump(oci_collection_assign($coll2, $coll1));

var_dump(oci_collection_element_get($coll2, 0));

echo "Done\n";

require dirname(__FILE__)."/drop_type.inc";

?>
--EXPECT--
bool(true)
bool(true)
bool(true)
string(6) "string"
Done
