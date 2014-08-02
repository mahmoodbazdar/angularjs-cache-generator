<?php
/**
 * test file for generate cache from command line
 */

require __DIR__."/../src/NgCacheGen.php";

$params=array();
foreach($argv as $arg){
    $parameter=explode("=",$arg);
    if(isset($parameter[1])){
        $params[$parameter[0]]=$parameter[1];
    }
}
$params["export"]=isset($params["export"])?$params["export"]:"cache";
$params["template"]=isset($params["template"])?$params["template"]:false;

$ngCacheGen=new \Bazdar\NgCache\NgCacheGen(__DIR__."/".$params["root"]);

$ngCacheGen->setExportName($params["export"]);
$ngCacheGen->setTemplateFile($params["template"]);

$ngCacheGen->generate();