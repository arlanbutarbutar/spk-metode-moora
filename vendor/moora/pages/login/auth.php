
<?php
//untuk memasukkan file koneksi
require_once "../../controller/koneksi.php";
/**
// menangkap variabel post dr form login / index.php
$username = $_POST ['username'];
$pass = $_POST ['password'];
$id_role = $_GET ['id_role'];



// pastikan password berupa huruf atau angka
if (!ctype_alnum ($username) OR !ctype_alnum($pass)) {
    echo "<center> LOGIN GAGAL !<br>
         MASUKAN DATA DENGAN BENAR.<br>
         Atau akun anda sedang diblokir.<br>";
    echo "<a href=../../index.php><b>ULANGI LAGI</b></a></center>";
} else {
    $login = mysqli_query ($conn, "SELECT * FROM users WHERE username='$username' AND password='$pass'");
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login, MYSQLI_ASSOC);
    
    //apabila username dan password ditemukan
    if ($ketemu > 0){
        session_start();
        
        $_SESSION['namauser'] = $r['username'];
        
        header('location:../index.php?module=home');
    } else {
        echo "<center> LOGIN GAGAL !<br>
         Username atau Password anda tidak benar.<br>
         Atau akun anda sedang diblokir.<br>";
        echo "<a href=../index.php><b>ULANGI LAGI</b></a></center>";
    }
}



// proses daftar
**/
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
  // Connect to database
  
  // Escape the inputs to prevent SQL injection
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Check if the username and password are correct
  $query = "SELECT id_role FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // If the username and password are correct, fetch the id_role
    $user = mysqli_fetch_assoc($result);
    $_SESSION['id_role'] = $user['id_role'];

    // Redirect the user to another page
    header('location:../index.php?module=home');
    exit;
  } else {
    // If the username and password are incorrect, show an error message
    echo 'Username atau password salah.';
  }
}




?>