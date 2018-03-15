<?php

function myfunction()
{
	
	if ($GLOBALS["sayi"] < 10000 $$ $GLOBALS["sayi"]>999)
	{
		$birler=$GLOBALS["sayi"]%10;
		$onlar=$GLOBALS["sayi"]%100/10;
		$yuzler=$GLOBALS["sayi"]%1000/100;
		$binler=$GLOBALS["sayi"]%10000/1000;
		
		$sayidegerleri=arrya($binler,$onlar,$yuzler,$binler);
		sort ($sayidegerleri);
		
		$boyut=count($sayidegerleri);
		$a=0;
		
		while($a<$boyut)
		{
			echo $sayidegerleri[$a]."";
			$a++;
			
		}
		
		foreach ($sayidegerleri as $key => $value) 
		{
			echo $key. "-->". $value . "<br />";
			
		}
		
		for($i=0 ; $i<4 ; $i++)
		{
			switch ($i)
			{
				case 0: $deger=$binler;break;
				case 1: $deger=$yuzler;break;
				case 2: $deger=$onlar;break;
				case 3: $deger=$birler;break;
				default: $deger=-i; break;
			}
			echo sayidegeri($deger)
		}
		
	}
	
	
}
?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>

</head>
<body>
	
	<form action="/lab.php" method="post">
	
	<span>Dört Basamaklı Sayı giriniz</span>
	<input name="girilensayi" type="number" />
	<button type="submit">Giriş</button>
	
	
	</form>
	
	
	

</body>
</html>