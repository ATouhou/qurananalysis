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
$headers="";
$eol="\r\n";
$mime_boundary=md5(time());
$fromaddress = "no-reply@qurananalysis.com";

# Common Headers
$headers .= 'From: QA <'.$fromaddress.'>'.$eol;
$headers .= 'Reply-To: QA<'.$fromaddress.'>'.$eol;
$headers .= 'Return-Path: QA <'.$fromaddress.'>'.$eol;    // these two to set reply address
$headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
$headers .= "X-Mailer: PHP v".phpversion().$eol;          // These two to help avoid spam-filters
$headers .= 'MIME-Version: 1.0'.$eol;

$headers .= 'Content-type: text/html; charset=UTF-8' . $eol;
//////////////////////////////////////////////////



$to  = "karim@qurananalysis.com";



$mail_result = mail($to,"QA Event",$body,$headers,"-f$fromaddress");

?>