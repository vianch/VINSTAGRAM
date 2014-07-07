<?php
/**
* VIANCH INSTAGRAM PHOTO GETTER Class, el ejemplo apenas está en desarrollo
*
* @author Victor Chavarro {@link http://www.vianch.com Victor Chavarro (victor@vianch.com)}
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

class vinstagram
{

	private $accesToken;
	private $instagramUser;

	/**
	* @access private
	* $instagram fetch all data from instagram request
	*/
	private $instagraData;

	public function __construct( $accesToken,  $_instagramUser )
	{
		if( ( $accesToken != null ) && ( strlen ( $accesToken ) > 3 ) && ( $_instagramUser != null ) )
		{
			$this->accesToken = $accesToken;
			$this->instagramUser = $_instagramUser;

			return true;
		}
		else
			return false;
	}

	/*
	* Get user photos from instagram
	* @see $instagramUser
	* @param int $limit : limited number of instagram photos
	*/
	public function GetUserPhotos( $limit = 1000 )
	{

		$getPhotosURL = "https://api.instagram.com/v1/users/".$this->instagramUser."/media/recent/?access_token=".$this->accesToken."&count=".$limit;
		$this->instagramData = $this->InstagramGetInformation( $getPhotosURL );

		unset($getPhotosURL);
		return $this->instagramData;
	}

	public function GetPhotosByHashtag( $_hashtag, $limit = 1000 )
	{
		$getPhotosURL = "https://api.instagram.com/v1/tags/".$_hashtag."/media/recent?access_token=".$this->accesToken."&count=".$limit;
		$this->InstagramGetInformation( $getPhotosURL );

		unset($getPhotosURL);
		return $this->instagramData;
	}

	public function InstagramGetInformation( $_URL, $returnArray = true, $_timeOut = 10 )
	{
		$instagramConnection = curl_init(); //inicializacion CURL

        /*PARAMETROS CURL*/
        curl_setopt($instagramConnection,CURLOPT_URL, $_URL); //Dirección URL a capturar
        curl_setopt($instagramConnection,CURLOPT_RETURNTRANSFER,1); //para devolver el resultado de la transferencia como string
        curl_setopt($instagramConnection,CURLOPT_CONNECTTIMEOUT,$_timeOut); //Número de segundos a esperar cuando se está intentado conectar.
                
        $this->instagramData = curl_exec($instagramConnection); //se conecta a la url
                
        curl_close($instagramConnection); //cierra la conexión
        unset($instagramConnection);

        if( !$this->instagramData || ( $this->instagramData === FALSE ) )
        	return false;
        else
        {
        	if( $returnArray )
				$this->instagramData = json_decode( $this->instagramData );
	      
	      	return true;          
        }
        	
	}

	public function GetInstagramData()
	{
		return $this->instagramData;
	}

	public function GetNextInformationUrl()
	{
		return $this->instagramData->pagination->next_url;
	}

	public function PrintInstagramInformation()
	{
		foreach ( $this->instagramData->data as $instagramPhoto ) 
		{
				echo "<a href='".$instagramPhoto->images->standard_resolution->url."' class='vinstagram-link' >
					<img src='".$instagramPhoto->images->thumbnail->url."' alt='instagram photo'/>
				</a>";
		}	

		echo "<div id='vinstagram-next' url='".$this->instagramData->pagination->next_url."' >NEXT</div>";
	}

	

	public function __destruct()
	{
		unset($this->accesToken);
		unset($this->instagramUser);
		unset($this->instagramData);
	}



}