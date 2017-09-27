<?php

function getname($param){
	include "konek.php";
	 $getdata = $connect->query("select * from company where CompanyID = '".$param."' ");
	 $row = $getdata->fetch_object();
	 echo "------".$row->CompanyName;

	  
}

function getproductname($params){
	include "konek.php";
	 $getdata = $connect->query("select a.*,b.CompanyName from product a
				left join company b on b.CompanyID = a.SupplierID where CompanyID = '".$params."' ");
	 $row = $getdata->fetch_object();
	 echo "------".$row->ProductName;
}
?>