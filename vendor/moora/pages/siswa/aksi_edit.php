<?php
// mengambil data koneksi
include "../../controller/koneksi.php";
// mengambil data dari form sebelumnya
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$ttl = $_POST['ttl'];
$nr = $_POST['nilai_raport'];
$pk = $_POST['presensi_kehadiran'];
$pot = $_POST['pekerjan_orang_tua'];
$pot2 = $_POST['penghasilan_orang_tua'];
$jt = $_POST['jumlah_tanggungan'];
$kk = $_POST['kondisi_keluarga'];
$id_siswa = $_GET['id_siswa'];
 
//nilai raport
/**
if ($nr>=9 || $nr<=10 ) {
	$nNR = 6;
}else if ($nr>7 || $nr<=8){
	$nNR = 5;
}else if($nr>=6 || $nr<=7){
	$nNR = 4;
}else if($nr>=5 || $nr<6){
	$nNR = 3;
}else if($nr>=4 || $nr<5){
	$nNR = 2;
}else if($nr>=2 || $nr<=3){
	$nNR = 1;
}
else{
	$nNR = 0;
}
//presensi kehadiran
if ($pk>=85% || $pk<=100% ) {
	$nPK = 6;
}else if ($pk=>65% || $pk<=80%){
	$nPK = 5;
}else if($pk>=45% || $pk<=60%){
	$nPK = 4;
}else if($pk>=35% || $pk<=40%){
	$nPK = 3;
}else if($pk>=15% || $pk<=30%){
	$nPK = 2;
}else if($pk>=5% || $pk<=10%){
	$nPK = 1;
}
else{
	$nPK = 0;
}

// pekerjaan ortu

if ($pot == 'Petani') {
	$nPOT = 6;
}else if($pot == 'Buruh'){
	$nPOT = 5;
}else if($pot == 'Nelayan'){
	$nPOT = 4;
}else if($pot == 'Pedagang'){
	$nPOT = 3;
}else if($pot == 'Swasta'){
	$nPOT = 2;
}else if($pot == 'PNS'){
	$nPOT = 1;
}else{
	$nPOT = 0;
}

//PENGHASILAN ORTU

if ($pot2<500000 ) {
	$nPOT2 = 6;
}else if ($pot2=>600000 || $pot2<=700000){
	$nPOT2 = 5;
}else if($pot2>=800000 || $pot2<=900000){
	$nPOT2 = 4;
}else if($pot2>=1000000 || $pot2<=3000000){
	$nPOT2 = 3;
}else if($pot2>=2000000 || $pot2<=4000000){
	$nPOT2 = 2;
}else if($pot2>=5000000 || $pot2<=10000000){
	$nPOT2 = 1;
}
else{
	$nPOT2 = 0;
}

//kondisi keluarga
if ($kk == 'Yatim Piatu') {
	$nKK = 4;
}else if($kk == 'Yatim'){
	$nKK = 3;
}else if($kkt == 'Piatu'){
	$nKK = 2;
}else if($kk == 'Lengkap'){
	$nKK = 1;
}else{
	$nKK = 0;
}

//jumlah tanggungan
//nilai raport
if ($jt>=9 || $nr<=10 ) {
	$nJT = 6;
}else if ($jt>7 || $jt<=8){
	$nJT = 5;
}else if($jt>=5 || $jt<=6){
	$nJT = 4;
}else if($jt>=4 || $jt<5){
	$nJT = 3;
}else if($jt>=2 || $jt<3){
	$nJT = 2;
}
else{
	$nJT = 1;
}

 // echo $nKPS."<br>";
 // echo $nPKH."<br>";
 // echo $nStatus."<br>";
 // echo $nEkonomi."<br>";
 // echo $penghasilan."<br>";
**/  

	//mengambil id siswa terkahir yang baru saja dimasukan
            
                $sqlSiswa = "UPDATE tabel_siswa SET nama= '$nama', jenis_kelamin='$jenis_kelamin',ttl='$ttl',nilai_raport='$nr',presensi_kehadiran='$pk',pekerjan_orang_tua='$pot',penghasilan_orang_tua='$pot2',jumlah_tanggungan='$jt',kondisi_keluarga='$kk' WHERE id_siswa = '$id_siswa' ";
                $conn->query($sqlSiswa);

				echo "<script>alert('Input berhasil');window.location = '../index.php?module=list_siswa';</script>";


// eksekusi sql

// if ($koneksi->query($sql) === TRUE) {
//     echo "<script>alert('Input berhasil');window.location = '../../index.php?module=list_kriteria';</script>";
// } else {
//     echo "Error: " . $sql . "<br>" . $koneksi->error;
// }

?>