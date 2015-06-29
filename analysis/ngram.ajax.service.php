<?php 
require_once("../global.settings.php");

$lang = "AR";



if ( isset($_GET['lang']) )
{
	$lang = $_GET['lang'];
}

loadModels("core,qac",$lang);



$ngramsType = $_GET['ngramsType'];
$parameter = $_GET['parameter'];


//echoN("$ngramsType $parameter");

// PoS NGrams
if ( $ngramsType==2)
{
	
	$nGramesArr = array();
	
	$posPatternString = trim($parameter);
	
	
	
	$nGramesArr = getPoSNGrams($posPatternString);
	
	
		
	
}
// NORMAL N-GRAMS
else if ( $ngramsType==1)
{
		
					$grams = $parameter;
					
					$nGramesArr = array();
					
					
					$nGramesArr = getNGrams($grams,2);
					
					
					
				
					
					
					//echoN("N-Grams Avg:".($avgCollocationFreq/($nGramsCount)));
					
					//$secondArr = array_slice($nGramesArr, floor($nGramsCount/2), 5);
					
					//preprint_r( ($secondArr));
					
					
					
					
					//arrayToCSV($nGramesArr);
					//$histoArr = histogramFromArray($nGramesArr);
					//plotHistogram($nGramesArr);
					
					/*foreach($histoArr as $key=>$val)
					{
						echoN("$key,$val");
					}*/
}				
					


$avgCollocationFreq = array_sum($nGramesArr);
	
$nGramsCount = count($nGramesArr);
					?>
					
					<table id='ngrams-results-table'>
					<thead>
					<tr>
						<td colspan='2'>
							
							Number of N-Grams:<b><?=addCommasToNumber($nGramsCount) ?></b>
							Total repetitions:<b><?=addCommasToNumber($avgCollocationFreq) ?></b>
							
						</td>
					</tr>
					</thead>
					<tr>
					<th>
						Words
					</th>
					<th>
						Frequency
					</th>
					</tr>
					
					<?php
				
						
				
					
					//echoN($nGramesArr[floor($nGramsCount/2)]);
					//preprint_r($nGramesArr);
					
					foreach($nGramesArr as $key=>$val)
					{
						
					?>
					<tr>	
						<td>
							<?=$key?>
						</td>
						<td>
							<?=$val?>
						</td>
					</tr>
					<?php 
					}
					?>
			</table>


