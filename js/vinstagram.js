 // IIFE - Immediately Invoked Function Expression
  (function(vinstagram){vinstagram(window.jQuery, window, document);}
  (function($, window, document) 
  {
   $(function() {
     
     // The DOM is ready!
     LoadNextInstagramPhotos( "#vinstagram-next" );
     OpenInstagramImage();
   });

   function LoadNextInstagramPhotos( nextDOM )
   {    
        var container =  $("#vinstagram-container");
        $("body").on("click", nextDOM,  function(event) {

          event.preventDefault();
          container.html( "<img src='images/load.gif' alt='load' />");
          
          var nextUrl = $(this).attr("url");

          var requestNextUrl = $.ajax({
            url: "controller/vinstagram.php",
            type: "GET",
            data: { type : "next", url : nextUrl },
            dataType: "html"
          });

          requestNextUrl.done( function( msg ){ 

           container.html( msg );

          });
          
        });
   }

   function OpenInstagramImage()
   {
      var linkDOM = $(".vinstagram-link");
      var instagramImageContainerDOM = $("#instagram-lightbox-container");
     

      linkDOM.on( "click", function( event ){

          var imgLink = $(this).attr("href");

          if(event.preventDefault)
          {
            event.preventDefault();
            event.stopImmediatePropagation();
          }
          else
            event.returnValue = false;

          $("<img src='images/load.gif' alt='load' />").load(function() {
            instagramImageContainerDOM.width("10px").height("10px").html(this);
          });


          $('<img src="'+ imgLink +'">').load(function() {
            instagramImageContainerDOM.width("612px").height("612px").html(this);
          });


      });
   }

  }));