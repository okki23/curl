<?php

  

function rowdata(){
	include "konek.php";
	$sqllog = $connect->query("select * from confmenues where MenuName = 'ClassificationID' and Active = '1' and LanguageID = 'no' ");
		$datalog = $sqllog->fetch_object();
		//var_dump($datalog);

		while ($datalog = $sqllog->fetch_object()) {

			$sqllogb =  $connect->query("select * from company where ClassificationID = '".$datalog->MenuValue."' ");
			$countb = mysqli_num_rows($sqllogb);

			echo $datalog->MenuChoice."Count : ". $countb. "<br>";
		}

}

rowdata();

?>