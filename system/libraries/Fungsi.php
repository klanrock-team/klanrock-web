<?php

function test(){
    return "succses";
}

function id_generate($kolom, $tabel,$length=1){
    $hasil = mysql_query("SELECT max($kolom) as maxid FROM $tabel");
    if (mysql_num_rows($hasil) >= 0) {
        $row = mysql_fetch_array($hasil);
        $no = (int)substr($row['maxid'], 1) + 1;
        return sprintf("%0".$length."s", $no);
    }
}
function rupiah($data){
    $output = "Rp. " . strrev(implode('.', str_split(strrev(strval($data)), 3)));
    return $output;
}
function diskon($data){
    $output = $data."%";
    return $output;
}
function bulan($data){
    $bln = array("01" => "Jan",
        "02" => "Feb",
        "03" => "Mar",
        "04" => "Apr",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agu",
        "09" => "Sep",
        "10" => "Okt",
        "11" => "Nov",
        "12" => "Des");
    $time = explode("-", $data);
    $format = $time[2] . " " . $bln[$time[1]] . " " . $time[0];
    return $format;
}
function hari($data){
    $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
    $hari = $dayList[$data];
    return $hari;
}
function hak_akses($level,$hasil){
    if($level) echo $hasil;
}
function tipe_ruang($data){
    $ruang = array(
      1 => "Kelas",
        2 =>"Laboratorium",
        3 => "Lain - Lain"
    );
    foreach ($ruang as $no => $nama){
        if($data == $no) return $nama;
    }
}

function kat($data){
    $ruang = array(
        1 => "Individu",
        2 =>"Team"
    );
    foreach ($ruang as $no => $nama){
        if($data == $no) return $nama;
    }
}

function validasi($data){
    return mysql_real_escape_string(stripslashes(trim(strip_tags($data))));
}
function tipe_golongan($data){
    $gol = array(1=>'Modal',2=>'BHP');
    foreach($gol as $no =>$nama){
        if($data == $no) return $nama;
    }
}

function cek_gambar_array($gambar,$i){
    $direktori = "../media/gambar/";
    // $URL = "/pembangunan_setda/media/gambar";
    $URL = "/siujon/media/gambar";
    $nama_baru = str_replace("","_",$gambar['name'][$i]);
    $direktori_baru = $direktori."/".$nama_baru;
    $max_file_size = 20000000;//5000 kb

    $format = array("image/jpg","image/jpeg","image/gif","image/png");
    if(!in_array($gambar['type'][$i],$format)) die("Tipe file salah");
    if($gambar['size'][$i]>$max_file_size) die("Ukuran file terlalu besar");
    if(file_exists($direktori_baru)) die("File telah ada");
    move_uploaded_file($gambar['tmp_name'][$i],$direktori_baru) or die("Gagal upload");
    return $URL."/".$nama_baru;
}


function cek_gambar($gambar){
    $direktori = "../media/gambar/";
    // $URL = "/pembangunan_setda/media/gambar";
    $URL = "/siujon/media/gambar";
    $nama_baru = str_replace("","_",$gambar['name']);
    $direktori_baru = $direktori."/".$nama_baru;
    $max_file_size = 20000000;//5000 kb

    $format = array("image/jpg","image/jpeg","image/gif","image/png");
    if(!in_array($gambar['type'],$format)) die("Tipe file salah");
    if($gambar['size']>$max_file_size) die("Ukuran file terlalu besar");
    if(file_exists($direktori_baru)) die("File telah ada");
    move_uploaded_file($gambar['tmp_name'],$direktori_baru) or die("Gagal upload");
    return $URL."/".$nama_baru;
}

function cek_file($gambar){
    $direktori = "../media/dokumen/";
    // $URL = "/pembangunan_setda/media/dokumen";
    $URL = "/siujon/media/dokumen";
    $nama_baru = str_replace("","_",$gambar['name']);
    $direktori_baru = $direktori."/".$nama_baru;
    $max_file_size = 20000000;//5000 kb

    $format = array("image/jpg","image/jpeg","image/gif","image/png");
    // if(!in_array($gambar['type'],$format)) die("Tipe file salah");
    if($gambar['size']>$max_file_size) die("Ukuran file terlalu besar");
    if(file_exists($direktori_baru)) die("File telah ada");
    move_uploaded_file($gambar['tmp_name'],$direktori_baru) or die("Gagal upload");
    return $URL."/".$nama_baru;
}

function level($data){
    $level = array(0=>"Super Admin",
        1=>"Admin");
    foreach($level as $index=>$nama){
        return ($index==$data)?$nama:"";
    }
}
function alert($tipe,$judul=null,$isi=null){
    return "<div class=\"alert alert-$tipe\">
  <strong>$judul</strong> $isi</div>";
}
function aktif_menu($menu,$data){
    if($menu == $data) echo "class='active'";
}

function backup($nama_file,$database,$tables = '')
{
    global $return, $tables, $back_dir, $database ;

    if($tables == '')
    {
        $tables = array();
        $result = @mysql_list_tables($database);
        while($row = @mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }else{
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return	= '';
    $return	.= "DROP DATABASE IF EXISTS ".$database."; CREATE DATABASE ".$database."; USE ".$database.";";
    foreach($tables as $table)
    {
        $result	 = @mysql_query('SELECT * FROM '.$table);
        $num_fields = @mysql_num_fields($result);

        //menyisipkan query drop table untuk nanti hapus table yang lama
//        $return	.= "DROP TABLE IF EXISTS ".$table.";";
        $row2	 = @mysql_fetch_row(mysql_query('SHOW CREATE TABLE  '.$table));
        $return	.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = @mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';

                for($j=0; $j<$num_fields; $j++)
                {
                    $row[$j] = @addslashes($row[$j]);
                    $row[$j] = @ereg_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }

    $nama_file;

    $handle = fopen($back_dir.$nama_file,'w+');
    fwrite($handle, $return);
    fclose($handle);
}


function restore($file) {
    global $rest_dir;

    $nama_file	= $file['name'];
    $ukrn_file	= $file['size'];
    $tmp_file	= $file['tmp_name'];

    if ($nama_file == "")
    {
        echo "Fatal Error";
    }
    else
    {
        $alamatfile	= $rest_dir.$nama_file;
        $templine	= array();

        if (move_uploaded_file($tmp_file , $alamatfile))
        {

            $templine	= '';
            $lines		= file($alamatfile);

            foreach ($lines as $line)
            {
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                $templine .= $line;

                if (substr(trim($line), -1, 1) == ';')
                {
                    mysql_query($templine) or print('Query gagal \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');

                    $templine = '';
                }
            }
            echo "<center>Berhasil Restore Database, silahkan di cek.</center>";

        }else{
            echo "Proses upload gagal, kode error = " . $file['error'];
        }
    }


}