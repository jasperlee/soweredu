<?php
class ADConf {
}
$accessId = ADConf::AccessId;
$accessKey = ADConf::AccessKey;
$dmsSkey = ADConf::DmsSKey;
if(!empty($_REQUEST["tisId"])){
	$tisId = $_REQUEST["tisId"];
} else {
	$tisId = ADConf::TisId;
}
?>
