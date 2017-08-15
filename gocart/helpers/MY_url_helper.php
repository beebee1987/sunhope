<?php

function theme_url($uri)
{
	$CI =& get_instance();
	return $CI->config->base_url('gocart/themes/'.config_item('theme').'/'.$uri);
}

//to generate an image tag, set tag to true. you can also put a string in tag to generate the alt tag
function theme_img($uri, $tag=false)
{
	if($tag)
	{
		return '<img src="'.theme_url('assets/img/'.$uri).'" alt="'.$tag.'">';
	}
	else
	{
		return theme_url('assets/img/'.$uri);
	}
	
}

function theme_js($uri, $tag=false)
{
	if($tag)
	{
		return '<script type="text/javascript" src="'.theme_url('assets/js/'.$uri).'"></script>';
	}
	else
	{
		return theme_url('assets/js/'.$uri);
	}
}

//you can fill the tag field in to spit out a link tag, setting tag to a string will fill in the media attribute
function theme_css($uri, $tag=false, $id=false)
{
	if($tag)
	{
		$media=false;
		$extra='';
		if(is_string($tag))
		{
			$media = 'media="'.$tag.'"';
		}
		if(is_string($id))
		{
			$extra = 'id="'.$id.'"';
		}
		return '<link href="'.theme_url('assets/css/'.$uri).'" type="text/css" rel="stylesheet" '.$media.' '.$extra.'/>';
	}
	
	return theme_url('assets/css/'.$uri);
}

//you can fill the tag field in to spit out a link tag, setting tag to a string will fill in the media attribute
function theme_unify_css($uri, $tag=false)
{
	if($tag)
	{
		$media=false;
		if(is_string($tag))
		{
			$media = 'media="'.$tag.'"';
		}
		return '<link href="'.theme_url($uri).'" type="text/css" rel="stylesheet" '.$media.'/>';
	}

	return theme_url($uri);
}

function theme_unify_js($uri, $tag=false)
{
	if($tag)
	{
		return '<script type="text/javascript" src="'.theme_url($uri).'"></script>';
	}
	else
	{
		return theme_url('assets/js/'.$uri);
	}
}
