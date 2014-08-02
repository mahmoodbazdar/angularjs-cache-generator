<?php

namespace Bazdar\NgCache;

class NgCacheGen{
    //root templates dir
    private  $root="";
    private $templateFile=false;
    private $template='angular.module("{{FILE-PATH}}", []).run(["$templateCache", function ($templateCache) {
                            $templateCache.put("{{FILE-PATH}}",
                                "{{FILE-DATA}}"
                            );
                        }]);';
    private  $exportName="cache";
    private  $minify=true;

    private $files=array();

    private $templateExt=array(
        "html"
    );




    private $prefix="";
    public function setTemplateFile(string $file){
        if(is_file($file)){
            $this->templateFile=$file;
        }
        else{
            throw new \Exception($file." dos not exist!");
        }
    }

    public function setExportName(string $exportName){
        $this->exportName=$exportName;
    }

    public function setMinify(boolean $minify){
        $this->minify=$minify;
    }

    public function setTemplateExt(array $ext){
        $this->templateExt=$ext;
    }

    public function setPrefix(string $prefix){
        $this->prefix=$prefix;
    }

    function NgCacheGen($root){
        if(is_dir($root)){
            $this->root=$root;
            $this->getDirFiles(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->root)));
        }
        else{
            throw new \Exception($root." is not a directory or dos not exist!");
        }
    }

    public function generate(){
        if($this->minify){
            require_once "lib/JSMin.php";
        }
        if($this->templateFile){
            $this->template=file_get_contents($this->templateFile);
        }
        $result="";
        foreach($this->files as $file){
            if($this->checkTemplateExt($file))
                continue;
            $fileContent=file_get_contents($file);
            $append=$this->template;
            $append=str_replace("{{FILE-PATH}}",str_replace("\\","/",$file),$append);
            $append=str_replace("{{FILE-DATA}}",str_replace('"','\"',$fileContent),$append);
            $result.=$append;
        }
        file_put_contents($this->exportName.".js",\JSMin::minify($result));
    }


    private function checkTemplateExt(string $file){
        foreach($this->templateExt as $ext){
            if(!preg_match("/.".$ext."/",$file)){
                return false;
            }
        }
        return true;
    }

    private function getDirFiles(\RecursiveIteratorIterator $iterator){
        foreach ($iterator as $path) {
            if ($path->isDir())
            {
                $this->getDirFiles($path);
            }
            else
            {
                $this->files[]=(string) $path;
            }
        }
    }
}