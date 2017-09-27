<?php
include "konek.php";
include "getnamequery.php";
$param = 1;

//cek pas login
$sqllog = $connect->query("select c.CompanyName,cs.ParentCompanyID,cs.ChildCompanyID 
				from company c left join companystruct cs on cs.ChildCompanyID = c.CompanyID
				where c.Active = 1 and cs.ChildCompanyID = '".$param."' ");
$datalog = $sqllog->fetch_object();

if($datalog->ParentCompanyID == '0'){
	echo "You login as HO";
}else{
	echo "You login as Department";
}

echo "<br>";
echo "<hr>";
echo "<br>";



$sqla = $connect->query("select c.CompanyName,cs.ParentCompanyID,cs.ChildCompanyID 
				from company c left join companystruct cs on cs.ChildCompanyID = c.CompanyID
				where c.Active = 1 and cs.ParentCompanyID = 0 and cs.ChildCompanyID = '".$param."' ");
 
 
while($dataa = $sqla->fetch_object() ){
 
	 echo "--".$dataa->CompanyName;
	 echo "<br>";
	 $sqlb = $connect->query("select c.CompanyName,cs.ParentCompanyID,cs.ChildCompanyID 
						from company c left join companystruct cs on cs.ChildCompanyID = c.CompanyID
						where c.Active = 1 and cs.ParentCompanyID = '".$dataa->ChildCompanyID."' ");

	// while ($datab = $sqlb->fetch_object()) {
		  
	// 	 //ChildCompanyID
	// 	echo "----".$datab->CompanyName;
	// 	echo "<br>";

		$listanak = mysqli_num_rows($sqlb);
		if($listanak > 0){

			//echo "ada ".$list;
			while($datab = $sqlb->fetch_object()){
				//var_dump($datab);
				echo "----".$datab->CompanyName."<br>";

				$sqlc = $connect->query("select crs.CompanyRelationStructID, crs.FromCompanyID,crs.ToCompanyID FROM companyrelationstruct AS crs
			LEFT JOIN company AS c ON (  c.CompanyID = crs.FromCompanyID AND crs.Active = '1' )
 			WHERE  crs.FromCompanyID = '".$datab->ChildCompanyID."' AND crs.Active = '1' ");

				$countbawah = mysqli_num_rows($sqlc);

					if($countbawah > 0){
						while ($databawah = $sqlc->fetch_object()) {
							echo getname($databawah->ToCompanyID)."<br>";

						}
					}else{
						echo " ------ nothing relation <br>";
					}

		 		}

		}else{

				echo "ga ada";

		}	 
		

	 
}

	 



 

?>