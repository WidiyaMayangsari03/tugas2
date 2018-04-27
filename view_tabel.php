<html>
<head>
<title>Form Mk View</title>
</head>
<body>
<table border="black 1px" width="500px">
	<tr>
		<td>Kode MK</td>
		<td>Nama MK</td>
		<td>SKS</td>
		<td>Nilai</td>
	</tr>
	
<?php
$ipk=0;	//ipk yang awal 
for ($n=1; $n <= $index; $n++) { 

	$ipk=(floatval($data[$n]['indeks'])*floatval($data[$n]['sks']))+$ipk;	//mengkonvert ke tipe data float
	echo '
		<tr>
			<td>'.$data[$n]['kode_mk'].'</td>	//menampilkan data dari array pada con
			<td>'.$data[$n]['nama_mk'].'</td>
			<td>'.$data[$n]['sks'].'</td>
			<td>'.$data[$n]['nilai'].'</td>
		</tr>
	';	
}
$total_sks = 0;	//
for ($n=1; $n <= $index ; $n++) { 
	$total_sks = $total_sks + intval($data[$n]['sks']);	//menjumlah sks
}
if ($total_sks>0) {
	echo '
		<tr>
			<td></td>
			<td></td>
			<td>IPK</td>
			<td>'.$ipk/$total_sks.'</td>	//dari ipk awal dibagi total sks, sehingga didapat ipk akhir 
		</tr>
	';
}
?>
</table>

<a href="index"><input type="submit" value="Tambah"></a>	
<a href="hapus_data"><input type="submit" value="Hapus"></a>
</body>
</html>
	