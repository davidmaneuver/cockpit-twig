<?php

if(!COCKPIT_ADMIN && !COCKPIT_REST) {

  $this->module("twig")->extend([

    "use" => function(Twig_Environment $env) use($app) {

      $twig_funcs = array();

      // REGIONS
      $twig_funcs[] = new Twig_SimpleFunction('region', function($name, $params = []){
        region($name, $params);
      });

      // COLLECTIONS
      $twig_funcs[] = new Twig_SimpleFunction('collection', function($name, $query = []){
        return collection($name)->find($query);
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
