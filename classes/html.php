<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML {
	
    public static function meta($key, $value, $name='name'){
        return '<meta '.$name.'="'.$key.'" content="'.$value.'">';
    }
    
    public static function metas($array_list, $name='name'){
        $list = '';
        foreach($array_list as $k => $v){
            $list.=HTML::meta($k, $v, $name);
        }
        return $list;
    }
    
    
	public static function attributes(array $attributes = NULL){
	    
	   
	    if(isset($attributes['name']) && !isset($attributes['id'])){
	        $attributes['id'] = $attributes['name'];
	    }
	    
	    if(!isset($attributes['name']) && isset($attributes['id'])){
	        $attributes['name'] = $attributes['id'];
	    }
	   
	    return parent::attributes($attributes);
	    
	}
	
	
	
	public static function styles($files, $end_line = "\n"){
	    
	    $list = array();
		foreach($files as $file){
			if($file){			    
			   $list[] = HTML::style($file).$end_line;
			}
		}
		return implode('', $list);
	}
	
	
	public static function scripts($files, $end_line = "\n", $atributes = array()){
	    
	    $list = array();
		foreach($files as $file){
			if($file){
			    $list[] = HTML::script($file, $atributes).$end_line;
			}
		}
		return implode('', $list);
	}
	
	
	public static function compress($html_source){
	    $source = $html_source;
	    $source = preg_replace('(\r|\n|\t)', '', $source);
        $source = preg_replace('(\r|\t)', '', $source);
        $source = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $source);
        $source = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $source);
        //remove espacoes duplos
        $source = preg_replace('/\s+/', ' ', $source);
        //remove comentarios
        $source = preg_replace('/<!--(.*)-->/Uis', '', $source);
        return $source;
    }
	

	
	
}