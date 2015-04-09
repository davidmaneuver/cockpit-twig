<?php

if(!COCKPIT_ADMIN && !COCKPIT_REST) {

  $this->module("twig")->extend([

    "use" => function(Twig_Environment $env) use($app) {

      $twig_funcs = array();

      // REGIONS
      $twig_funcs[] = new Twig_SimpleFunction('region', function($name, $params = []){
        return cockpit('regions:render', $name);
      });

      $twig_funcs[] = new Twig_SimpleFunction('region_field', function($region, $field, $params = []){
        $value = cockpit('regions:region_field', $region, $field, 'value');
        $region_obj = cockpit('regions:get_region', $region);
        $field_obj = array_filter($region_obj['fields'], function ($i) use ($field) { return $i['name'] == $field; });
        if (!empty($field_obj)) {
          $field_obj = array_pop($field_obj);
          if ($field_obj['type'] == 'markdown') {
            $value = cockpit("cockpit")->markdown($value);
          }
        }
        echo $value;
      });

      // COLLECTIONS
      $twig_funcs[] = new Twig_SimpleFunction('collection', function($name, $query = [], $array = true){
        $items = collection($name)->find($query);
        return $array ? $items->toArray() : $items;
      });

      // MEDIAMANAGER
      $twig_funcs[] = new Twig_SimpleFunction('thumbnail', function($image, $width = null, $height = null, $options = []){
        thumbnail($image, $width, $height, $options);
      });
      $twig_funcs[] = new Twig_SimpleFunction('thumbnail_url', function($image, $width = null, $height = null, $options = []){
        return thumbnail_url($image, $width, $height, $options);
      });

      // GALLERIES
      $twig_funcs[] = new Twig_SimpleFunction('gallery', function($name){
        return cockpit("galleries")->gallery($name);
      });

      // FORMS
      $twig_funcs[] = new Twig_SimpleFunction('form', function($name, $options = []){
        cockpit("forms")->form($name, $options);
      });

      // Add functions to Twig.
      foreach ($twig_funcs as $func) {
        $env->addFunction($func);
      }
    }

  ]);

}
