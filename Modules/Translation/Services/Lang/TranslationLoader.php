<?php

namespace Modules\Translation\Services\Lang;

use \App\Fragment;
use Cache;
use Illuminate\Translation\FileLoader;
use Illuminate\Support\Facades\DB;

class TranslationLoader extends FileLoader
{
    protected function loadPath($path, $locale, $group)
    {
        

        
        return Cache::rememberForever("{$locale}.{$group}",
            function () use ($group, $locale) {
                //logd($group."  ".$locale);
                
                //$sql="SELECT `key`,`{$locale}` FROM `translation` WHERE `group`='{$group}' and `{$locale}` <> ''";
        
                $sql="select `group`,`key`,`text`,`code_locale` from translations INNER JOIN transkeys on translations.id_transkey = transkeys.id where `code_locale`=\"{$locale}\" and `group`=\"{$group}\" and translations.text <> ''";
                $keys = DB::select($sql);
                //echo $sql;
                
                $data=[];
                foreach ($keys as $key) {
                   $data[$key->key]=$key->text;
                }

               // dd($data);

                return $data;
            }
        );

        // if ($this->files->exists($full = "{$path}/{$locale}/{$group}.php")) {
        //     return $this->files->getRequire($full);
        // }

        return [];
    }
}