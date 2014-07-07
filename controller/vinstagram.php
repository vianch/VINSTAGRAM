<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if( is_file("class/vinstagram.class.php") )
	include_once "class/vinstagram.class.php";
else
	include_once "../class/vinstagram.class.php";
$instagram = new vinstagram( "4285389.04e0db3.fe228b9ef2c8423291ad4efc5dda3319", "4285389" );

if( isset( $_REQUEST["type"] ) )
{
	$type = $_REQUEST["type"];

	switch ($type) {

		case 'instagramUserInfo':
			$instagram->GetUserPhotos();
			break;

		case 'instagramHashtag':
			$instagram->GetPhotosByHashtag( "rockalparque", 50 );
			break;
		
		default:
			
			if( isset($_REQUEST["url"] ) )
			{
				$_URL = $_REQUEST["url"];
				$instagram->InstagramGetInformation( $_URL );
				unset($type);
			}	
			break;

	}

	$instagram->PrintInstagramInformation();
	unset($type);
}


