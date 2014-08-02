angularjs-cache-generator
=========================

generates Angularjs cache from html files.

example:
add template address in construct function parameter
```
$ngCacheGen=new \Bazdar\NgCache\NgCacheGen("/templates");
```
class will append .js ext at the end

```
$ngCacheGen->setExportName("cacheFileName");
```
set which files must process with class by default html files will processed

```
$ngCacheGen->setTemplateExt("html");
```
prefix address before html file

 ex:
 template file real address: /library/templates/test/action.html

 current class instance dir: /library/gen.php

 then prefix = /library/

```
$ngCacheGen->setPrefix("/library/");
```
you also can change default cache template
example of template file: src/cacheTemplate.js
```
$ngCacheGen->setTemplateFile(__DIR__."/templateCache.js");
```

