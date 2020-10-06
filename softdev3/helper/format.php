<?php

  class Format
  {
  	public function formateDate($data){
  		 return date("F j, Y - g:i a", strtotime($data));
  	}

  	public function textshorten($text , $limit = 400){
  		$text = $text." ";
  		$text = substr($text,0,$limit);
  		$text = substr($text,0,strrpos($text,' '));
  		$text = $text."...";
  		return $text;
  	}

  }
?>
