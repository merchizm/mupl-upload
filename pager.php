<?php

function paginateRecords($dataFile,$page,$numRecs=5){

$output='';

// validate data file

(file_exists($dataFile))?$data=(file($dataFile)):die('bilgi dosyası bulunamadı.');

// validate number of records per page

(is_int($numRecs)&&$numRecs>0)?$numRecs=$numRecs:die('Invalid number of records '.$numRecs);

// calculate total of records

$numPages=ceil(count($data)/$numRecs);

// validate page pointer

if(!preg_match("/^\d{1,2}$/",$page)||$page<1||$page>$numPages){

$page=1;

}

// retrieve records from flat file

$data=array_slice($data,($page-1)*$numRecs,$numRecs);

// append records to output

foreach($data as $row){

$output.=$row;

}

$output.='<tr><td colspan=5 height=10></td></tr><tr><td colspan=5><br>Sayfalar: ';

if($page>1){
$output.='<a href="'.$_SERVER['PHP_SELF'].'?page='.($page-1).'">&lt;&lt;geri</a>&nbsp;';
}

// create intermediate links
for($i=1;$i<=$numPages;$i++){
($i!=$page)?$output.='<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>&nbsp;':$output.=$i.'&nbsp;';

if (is_int($i/30)) $output.="<br>";
}

if($page<$numPages){
$output.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.($page+1).'">ileri&gt;&gt;</a> ';
}

$output.='</td></tr>';
return $output;

}
?>