<?php
//Panggil File excel_reader2
include "excel_reader2.php";
//Panggil File koneksi
include "Koneksi.php";

//Membaca File Excel yang di upload
$data=new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

//Membaca jumlah baris(Excel)
$baris=$data->rowcount($sheet_index=0);

//Nilai Awal untuk jumlah data yang sukses dan gagal di import
$sukses=0;
$gagal=0;

//import data excel mulai dari baris ke 2 (karena baris pertama adalah nama  kolom)
for($i=2;$i<$baris;$i++)
{
  //membaca data judul buku (kolom ke-1)
  $judul_buku=$data->val($i,1);
  //membaca data Penerbit (kolom ke-2)
  $penerbit=$data->val($i,2);
  //membaca data Penulis (kolom ke-3)
  $penulis=$data->val($i,3);
  //membaca data Tahun Terbit (kolom ke-4)
  $tahun_terbit=$data->val($i,4);

  //simpan ke table buku
  $hasil=mysql_query("InSERT INTO tbuku(judul_buku,penerbit,penulis,tahun_terbit)
  values ('$judul_buku','$penerbit','$penulis','$tahun_terbit')");

  //Jika simpan sukses
  if($hasil)
  {
      $sukses++;
  }
  else {
    $gagal++;
  }
}

//Menampilkan Status sukses dan gagal
echo "<h3>Proses Import Data Selesai.</h3>";
echo "Jumlah Data yang sukses di Import : ".$sukses."<br>";
echo "Jumlah Data yang gagal di Import : ".$gagal."</p>";
 ?>
