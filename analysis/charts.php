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
    <title>Quran Analysis Charts | Quran Analysis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Analytics Charts for the Quran">
    <meta name="author" content="">

	<script type="text/javascript" src="<?=$JQUERY_PATH?>" ></script>
	<script type="text/javascript" src="<?=$MAIN_JS_PATH?>"></script>
	<script type="text/javascript" src="<?=$D3_PATH?>"></script>
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
			  	
			  	<div id='fqt-search-area'>
					
					<fieldset class="word-cloud-fs" >
		  		 
  				    <legend>Chapter/Verse distribution</legend>
						<div id="charts-verses-persura" >
							<?php 
							
							$TOTALS = getModelEntryFromMemory($lang, "MODEL_CORE", "TOTALS", "");
							
							$suraVerseArr = array();
							foreach ($TOTALS['TOTAL_PER_SURA'] as $suraIndex => $perSuraArr )
							{
								$suraVerseArr[] = array($suraIndex+1,$perSuraArr['VERSES']);
							}
							
							$suraVerseDistributionChartJSON  = json_encode($suraVerseArr);
							
						
							?>
						</div>
				   </fieldset>
					
				</div>
	
		  		
			
   </div>
   
		<?php 
				require("./analysis.template.end.code.php");
		
		?>	
		
	<script type="text/javascript">


				
		$(document).ready(function()
		{

			drawChart(<?=$suraVerseDistributionChartJSON?>,800,200,1,<?=$numberOfSuras?>,'#charts-verses-persura',"Chapter Number","Number Of Verses",function(d){return "Chapter Number:" + d[0]+ "<br/>Verses: "+d[1]} );
			
		
		});


		
	</script>
		

	<?php 
		require("../footer.php");
	?>
	


  </body>
</html>







