<?php 
#   PLEASE DO NOT REMOVE OR CHANGE THIS COPYRIGHT BLOCK
#   ====================================================================
#
#    Quran Analysis (www.qurananalysis.com). Full Semantic Search and Intelligence System for the Quran.
#    Copyright (C) 2015  Karim Ouda
#
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
#    You can use Quran Analysis code, framework or corpora in your website
#	 or application (commercial/non-commercial) provided that you link
#    back to www.qurananalysis.com and sufficient credits are given.
#
#  ====================================================================
require_once("../global.settings.php");


$lang = "AR";


if ( isset($_GET['lang']) )
{
	$lang = $_GET['lang'];
}

loadModels("core",$lang);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Quran Word Similarity | Quran Analysis </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Word similarity tool for the Quran">
    <meta name="author" content="">

	<script type="text/javascript" src="<?=$JQUERY_PATH?>" ></script>
	<script type="text/javascript" src="<?=$MAIN_JS_PATH?>"></script>
	<link rel="stylesheet" href="/qe.style.css?bv=<?=$BUILD_VERSION?>" />
	<link rel="icon" type="image/png" href="/favicon.png">	 
	<script type="text/javascript">
	</script>
     
       
  </head>
  <body>
  
		<?php 
				require("./analysis.template.start.code.php");
		
		?>	
				
  <div id='main-container'>
			  	
			    <?php include_once("help-content.php"); ?>

			
				Enter Arabic or English word
				<br/>
				<br/>
				<input type="text" id='arabic-english-word' name="word" />
				<input type="button" value="Find" id='show-button'  />
				
				
		
		
			
			<div id="loading-layer">
			  		Loading ...
					</div>
	
			  
			  	
			  	<div id='simmilar-words-area'>
					
				</div>
	
		  		
			
   </div>
   
   		<?php 
				require("./analysis.template.end.code.php");
		
		?>	

	<script type="text/javascript">


				
		$(document).ready(function()
		{


		
		});

    	$("#arabic-english-word").keyup(function(e){ 
		    var keyCode = e.which; 
		    
		    if(keyCode==13)
		    {
		    	e.preventDefault();
		      	$("#show-button").click();
		    } 
		});

		$("#show-button").click(function()
				{
			        var word = $("#arabic-english-word").val();

				
					if ( word=="" )
					{
						return;
					}



					$("#loading-layer").show();

					showSimilarity(word);

						  
				});

				
				function showSimilarity(word)
				{
				

			
						$("#simmilar-words-area").html("");
						
						$.ajaxSetup({
							url:  "/analysis/simmilar-words.ajax.service.php?lang=<?=$lang?>&word="+encodeURIComponent(word),
							global: false,
							type: "GET"
							
						  });


						$.ajax({
							
							timeout: 60000,
							success: function(retRes)
									{

								  			$("#loading-layer").hide();
								      	 	
								  			$("#simmilar-words-area").html(retRes);


								  			trackEvent('ANALYSIS','simmilar-words',word,'');
			
								 	 	
								     },
							      	 error: function (xhr, ajaxOptions, thrownError)
							         {
							      		$("#simmilar-words-area").html("<center>Error occured !</center>");
							      		$("#loading-layer").hide();
							         }
								});
									
						
						
						
						
						
				}


				


		
	</script>
		

	<?php 
		require("../footer.php");
	?>
	


  </body>
</html>







