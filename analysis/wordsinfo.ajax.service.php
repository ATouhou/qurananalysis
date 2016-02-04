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
require_once("../libs/search.lib.php");

//only arabic is supported here, english $lang spoils the functions
$lang = "AR";





loadModels("core,search,qac",$lang);


$WORDS_TRANSLATIONS_EN_AR = apc_fetch("WORDS_TRANSLATIONS_EN_AR");

$WORDS_TRANSLATIONS_AR_EN = apc_fetch("WORDS_TRANSLATIONS_AR_EN");



$WORDS_TRANSLITERATION = apc_fetch("WORDS_TRANSLITERATION");



$word = $_GET['word'];


		$wordInfoArr = getWordInfo($word,$MODEL_CORE,$MODEL_SEARCH,$MODEL_QAC);
		
		if ( empty($wordInfoArr))
		{
			showTechnicalError("Word not found");
			$suggestionsArr = getSimilarWords($lang,array($word));
			
			if ( !empty($suggestionsArr))
			{
				$suggestionsArr = array_slice($suggestionsArr, 0,10);
				
				echoN("<b>Do you mean</b>:<br>".join(", ", array_keys($suggestionsArr)));
			}
			exit;
		}
		
		//preprint_r($wordInfoArr);
		
		/*
		echoN("Buckwalter Transliteration:".$buckwalterTransliteration);
		echoN("Translation:"."");
		echoN("English Translation:"."");
		
		echoN("Word Root:".$wordRoot);
		echoN("PoS Tags:".join(",", array_keys($posTagsArr)));
		echoN("Lemmas:".join(",", array_keys($lemmasArr)));
		*/
		
		//preprint_r($versesArr);
		
		
		
		$wordUthmani = $wordInfoArr['WORD_UTHMANI'];
					
?>
					
					<table id='words-info-table'>
					<thead>
					<tr>
						<td colspan='6'>

						</td>
					</tr>
					</thead>
					<tr>	
						<th>
							Simple
						</th>
						<td>
							<?=$wordInfoArr['WORD_SIMPLE']?>
						</td>
						<th>
							Uthmani
						</th>
						<td>
							<?=$wordUthmani?>
						</td>
					</tr>
		
					<tr>	
						<th>
							Frequency
						</th>
						<td>
							<?=$wordInfoArr['TF']?>
						</td>
						<th>
							TF-IDF Weight
						</th>
						<td>
							<?=round($wordInfoArr['TFIDF'],2)?>
						</td>
					</tr>

					<tr>	
						<th>
							Buckwalter Transliteration
						</th>
						<td>
							<?=$wordInfoArr['BUCKWALTER']?>
						</td>
						<th>
							Transliteration
						</th>
						<td>
							<?=$WORDS_TRANSLITERATION[$wordUthmani]?>
						</td>
					</tr>
					<tr>	
						<th>
							English Translation
						</th>
						<td>
							<?=cleanEnglishTranslation($WORDS_TRANSLATIONS_AR_EN[$wordUthmani])?>
						</td>
						<th>
							Word Root
						</th>
						<td>
							<?=$wordInfoArr['ROOT']?>
						</td>
					</tr>	
					<tr>	
						<th>
							PoS Tags (<a target="_new" href="http://corpus.quran.com/documentation/tagset.jsp">QAC</a>)
						</th>
						<td>
							<?=join(",", array_keys($wordInfoArr['POS']))?>
						</td>
						<th>
							Lemma
						</th>
						<td>
							<?=join(" ", array_keys($wordInfoArr['LEM']))?>
						</td>
					</tr>	
					
					
					<tr>
						<th >
						Features
						</th>
						<td colspan='6'>
							<?=echoN(join(",",array_keys($wordInfoArr['FEATURES'])));?>
						</td>
	
						
					</tr>	
					<tr>
						
						<th colspan='5'>
							Verses (<?=count($wordInfoArr['VERSES'])?>)
						</th>
						<th>
						Tag
						</th>
						<th>
						Loc
						</th>
						
						
					</tr>		
					<?php 
					foreach ($wordInfoArr['VERSES'] as $location => $verseText):
					
					
					?>
					<tr>
						
						<td colspan='5'>
							<?php
							
							//$verseText = markSpecificWordInText($verseText,$wordId,$wordSimple,"");
							
							$markingTagName = "marked_fg";
							$verseText = preg_replace("/(".$wordInfoArr['WORD_SIMPLE'].")/mui", "<$markingTagName>\\1</$markingTagName>", $verseText);
							
							echo $verseText;
							
							?>
						</td>
						<td style="background-color: #cacaff">
						<?=$wordInfoArr['VERSES_POS_TAGS'][$location]?>
						</td>
						<td><?=$location?></td>
					</tr>
					<?php 
					endforeach;
					?>							
			</table>

			
			

