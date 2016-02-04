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

//loadModels("core,qac",$lang);







$ONTOLOGY_EXTRACTION_FOLDER = "../data/ontology/extraction/";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Quran QA Ontology | Quran Analysis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="QA Semantic Ontology for the Quran">
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
			  
			  <div style='width:100%;text-align:center'>
					The data below is extracted from QA Ontology V1.0
					<br>
					<!--A new version of the ontology V1.1 will be released in November 2015-->
			  </div>
			  	
			  	<div id='ontology-main-area'>
			  	
						<table id="ontology-container-table">
							<tr>
								<td >

  				   						 
  				   						 <?php  
  				   						 $finalConcepts = unserialize(file_get_contents("$ONTOLOGY_EXTRACTION_FOLDER/temp.final.concepts.final")); 
  				   						 
  				   						 	//preprint_r($finalConcepts);exit;
  				   						 ?>
  				   						 
  				   						 <table id='ontology-concepts-table'>
  				   						 <tr>
  				   						 <th>
  				   						Concepts (<?=count($finalConcepts)?>)
  				   						 </th>
  				   						 </tr>
  				   						
  				   						 	
  				   						 <?php
  				   						
  				   						 
  				   						 
	  				   						  foreach($finalConcepts as $concept=> $conceptArr)
	  				   						  {
  				   						 		
	  				   						  	
	  				   						
  				   						 
  				   						 	?>
  				   						 	   <tr>
  				   								 <td style="background-color: #dddddd;">
  				   						 			
  				   						 					<?php echo  $concept?> 
  				   						 			
  				   						 		 </td>
  				   						 		  <td >
  				   						 			
  				   						 					<?php /* echo  $conceptArr['EXTRACTION_PHASE']*/?> 
  				   						 			
  				   						 		 </td>
  				   						 		</tr>
  				   						 					
  				   						 	<?php
  				   						 						
  				   						 	   }
  				   						 	?>
  				   						 					
  				   						 </table>
  				   						 
  				   				
								</td>
								<td>
								
									
									
										<?php 
										 $relationArr = unserialize(file_get_contents("$ONTOLOGY_EXTRACTION_FOLDER/temp.final.relations"));
										 
										 //preprint_r($finalConcepts);
										 //preprint_r($relationArr);
										 
										 
										 ?>
										 <table id='ontology-concepts-table'>
  				   						 <tr>
  				   						 <th colspan='2'>
  				   						Relations (<?=count($relationArr)?>)
  				   						 </th>
  				   						 </tr>
  				   						
  				   						 	
  				   						 <?php
  				   						
  				   						 
  				   						 
  				   						 
	  				   						  foreach($relationArr as $index=> $relationsArr)
	  				   						  {
  				   						 		
  				   						 		$subject = $relationsArr['SUBJECT'];
  				   						 		$verb = $relationsArr['VERB'];
  				   						 		$object = $relationsArr['OBJECT'];
  				   						 		
  				   						 		$type = $relationsArr['TYPE'];
  				   						 		$posPattern = $relationsArr['POS_PATTERN'];
  				   						 		
  				   						 	?>
  				   						 	   <tr>
  				   								 <td style="background-color: #dddddd;">
  				   						 			
  				   						 				<?php echo  "$subject -> $verb -> $object"?> 
  				   						 			
  				   						 		 </td>
  				   						 		 <td style='color:#eee'>
  				   						 		 		<?php /*echo  $type*/?> 
  				   						 		 </td>
  				   						 		 <!--  <td style='color:#eee'>
  				   						 		 		<?php echo  "";//$posPattern?> 
  				   						 		 </td>
  				   						 		 --> 
  				   						 		</tr>
  				   						 					
  				   						 	<?php
  				   						 						
  				   						 	   }
  				   						 	?>
  				   						 					
  				   						 </table>
								</td>
							</tr>
						</table>
				</div>
	
		  		
			
   </div>
   
		<?php 
				require("./analysis.template.end.code.php");
		
		?>	
	<script type="text/javascript">


				
		$(document).ready(function()
		{


		
		});


		
	</script>
		

	<?php 
		require("../footer.php");
	?>
	


  </body>
</html>







