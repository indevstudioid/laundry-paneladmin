<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : login.php                                      #
#                                               Release Date  :                                                     #
#                                               Created       : 20/04/16 02.23                                      #
#                                               Last Modified : 22/04/16 01.08                                      #
#                                                                                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                                SIK BERKAITAN KARO LOGIN                                           #
#-------------------------------------------------------------------------------------------------------------------#

# Include Dari System
require ('../system/jenglot.php');

# Sudah Login Dan Menyimpan Session 
sudahMasuk();

#-------------------------------------------------------------------------------------------------------------------#
# Jika Login Ditekan
#-------------------------------------------------------------------------------------------------------------------#
if( isset($_POST['login']) ){
    
    session_start();

    
    function antiinjection($data){
    $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
    return $filter_sql;
    }

    $username = antiinjection($_POST['username']);
    $password     = md5($_POST['password'],"g4r4m");

    
    
    //cek data yang dikirim, apakah kosong atau tidak
    if (empty($username) && empty($password)) {
        //kalau username dan password kosong
        header('location:login?error=1');
        break;
    }
    
    else if (empty($username)) {
        //kalau username saja yang kosong
        header('location:login?error=2');
        break;
    }
    
    else if (empty($password)) {
        //kalau password saja yang kosong
        header('location:login?error=3');
        break;
    }
    
     
    $op = $_GET['op'];

    if($op=="in"){
        $login = mysql_query("SELECT * FROM user, admin WHERE user.id_user=admin.id_user AND username='$username' AND password='$password' AND tingkat_user=1");
        $ketemu=mysql_num_rows($login);
        $r=mysql_fetch_array($login);

        // Apabila username dan password ditemukan
        if ($ketemu > 0){
            session_start();
            $_SESSION['email'] = $r['email'];
            $_SESSION['foto'] = $r['foto'];
            $_SESSION['nama_lengkap'] = $r['nama_lengkap'];
            $_SESSION['no_telp'] = $r['no_telp'];
            $_SESSION['id_user'] = $r['id_user'];
            $_SESSION['username'] = $r['username'];
            $_SESSION['tingkat_user'] = $r['tingkat_user'];
            header("location:dashboard");
        }
        else {
            //kalau username ataupun password tidak terdaftar di database
            header('location:login?error=4');
        }
        
    }
    
    else if($op=="out"){
        
        unset($_SESSION['id_user']);
        unset($_SESSION['username']);
        unset($_SESSION['tingkat_user']);
        header("location:login");
    }
}


# Buka Head Login
BukaHeadLogin();
            
# kode php ini kita gunakan untuk menampilkan pesan eror
if (!empty($_GET['error'])) {
    if ($_GET['error'] == 1) {
        echo '<p><center><font color="red">Username dan Password kosong!</font></center></p>';
    }
    else if ($_GET['error'] == 2) {
        echo '<h3><center><font color="red">Username belum diisi!</font></center></h3>';
    }
    else if ($_GET['error'] == 3) {
        echo '<h3><center><font color="red">Password belum diisi!</font></center></h3>';
    }
    else if ($_GET['error'] == 4) {
        echo '<p><center><font color="red">Username atau Password salah!</font></center></p>';
    }
}
?>
        <form id="login" action="login.php?op=in" name="login" method="post">
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Username Dan Password Masih Kosong</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" id="username" placeholder="Username" required />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Password" required/>
            </div>
            <div class="inputwrapper animate3 bounceIn">
           
                <button type="submit" value="login" name="login" title="Login">LOGIN</button>
            </div>
        </form>

<?php
# Buka Footer Admin 
BagianfooterAdmin();
?>
