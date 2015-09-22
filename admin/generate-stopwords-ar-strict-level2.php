<?php 
require_once("../global.settings.php");
require_once("../libs/core.lib.php");

loadModels("core,qac", "AR");


$UTHMANI_TO_SIMPLE_WORD_MAP_AND_VS  = loadUthmaniToSimpleMappingTable();

$UTHMANI_TO_SIMPLE_LOCATION_MAP = apc_fetch("UTHMANI_TO_SIMPLE_LOCATION_MAP");


$LEMMA_TO_SIMPLE_WORD_MAP = loadLemmaToSimpleMappingTable();


printHTMLPageHeader();

//$qacMasterTableEntryArr2 = getModelEntryFromMemory("AR","MODEL_QAC","QAC_POS",$qacLocation);


$qacPoSTagsIterator = getAPCIterator("AR\/MODEL_QAC\/QAC_POS\/.*");



foreach($qacPoSTagsIterator as $qacPoSTagsIteratorCursor)
{

	$POS_ARR = $qacPoSTagsIteratorCursor['value'];
	$key = $qacPoSTagsIteratorCursor['key'];
	$POS = getEntryKeyFromAPCKey($key);
	
	if ( $POS=="N" || $POS=="PN" || $POS=="ADJ") continue;
	//echoN("|$POS|");
	
	
	foreach($POS_ARR as $location => $segmentId)
	{
		

		
		$qacMasterTableEntry = getModelEntryFromMemory("AR","MODEL_QAC","QAC_MASTERTABLE",$location);
		
	
		// get Word, Lema and root
		$segmentWord = $qacMasterTableEntry[$segmentId-1]['FORM_AR'];
		$segmentWordLema = $qacMasterTableEntry[$segmentId-1]['FEATURES']['LEM'];
		$segmentWordRoot = $qacMasterTableEntry[$segmentId-1]['FEATURES']['ROOT'];
		$verseLocation = substr($location,0,strlen($location)-2);
		//$segmentWord = removeTashkeel($segmentWord);
		
		
		
		if ( $POS=="DET"  )
		{
			// second segment PoS
			$segmentPoStag = $qacMasterTableEntry[$segmentId]['TAG'];
			
			//number of segments
			$numberOfSegmentsInWord = count($qacMasterTableEntry);
			
			if ( ($segmentPoStag=="N" || $segmentPoStag=="ADJ") && $numberOfSegmentsInWord==2 )
			{
				continue;
			}
			
			
		}
	
	
		// get word index in verse
		$wordIndex = (getWordIndexFromQACLocation($location));
	
	
		//$segmentFormARimla2y = $UTHMANI_TO_SIMPLE_WORD_MAP_AND_VS[$segmentWord];
		
		//echoN($segmentFormARimla2y);

		// get simple version of the word index
		$imla2yWordIndex = getImla2yWordIndexByUthmaniLocation($location,$UTHMANI_TO_SIMPLE_LOCATION_MAP);
	
	
		// get verse text
		$verseText = getVerseByQACLocation($MODEL_CORE,$location);
			
		$imla2yWord = getWordFromVerseByIndex($MODEL_CORE,$verseText,$imla2yWordIndex);
			
		//echoN($imla2yWord);
		
		$stopWordsFromQuran[$imla2yWord]=1;
			
		echoN($imla2yWord);
	
	}
}

$ya = "يا";

//add يا
$stopWordsFromQuran[$ya]=1;


echoN(count($stopWordsFromQuran));
//preprint_r($stopWordsFromQuran);


file_put_contents(dirname(__FILE__)."/../data/quran-stop-words.strict.l2.ar", implode("\n", array_keys($stopWordsFromQuran)));
exit;

?>