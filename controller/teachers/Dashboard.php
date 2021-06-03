<?php
@include '../../config/config.php';

class statistic
{

    public function nama_saya($host, $key)
    {
        $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password = '$key'");

        while ($row = mysqli_fetch_array($sql)) {
            $last_name = $row['last_name'];
            $first_name = $row['first_name'];
        }

        $My_name = [$last_name, $first_name];

        return $My_name; //returning
    }

    public function CekNohpsiswa($host, $key)
    {
        $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$key'");

        while ($row = mysqli_fetch_array($sql)) {

            $nohp = $row['nohp_siswa'];
        }

        if ($nohp == NULL) {

            return 0;
        } else {

            return 1;
        }
    }

    public function Nohpsiswa($host, $key)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$key'");

        while ($row = mysqli_fetch_array($sql)) {
            $nohp = $row['nohp_siswa'];
        }

        return $nohp;
    }

    public function getEmailsiswa($host, $key)
    {
        $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$key'");

        while ($row = mysqli_fetch_array($sql)) {
            $email = $row['email'];
        }

        return $email;
    }

    public function getEmailguru($host, $key)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password='$key'");

        while ($row = mysqli_fetch_array($sql)) {
            $email = $row['email'];
        }

        return $email;
    }

    public function show_all_class($host, $key)
    {
        $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author = '$key'");

        while ($row = mysqli_fetch_array($sql)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function chek_class_null($host, $key)
    {
        $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author = '$key'");

        $cek = mysqli_num_rows($sql);

        if ($cek == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function ViewProfile($host, $key)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password='$key'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function get_Caption($host, $class_code)
    {

        $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas='$class_code'");

        while ($row = mysqli_fetch_array($sql)) {

            $caption = $row['caption'];
        }

        return $caption;
    }

    public function update_caption($host, $class_code)
    {

        $caption = $_POST['caption'];

        $sql = mysqli_query($host, "UPDATE identitas_kelas SET caption='$caption' WHERE kode_kelas='$class_code'");

        if ($sql) {

            return true;
        } else {

            echo "eror";
        }
    }

    public function EditProfileGuru_withPass($host)
    {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $id = $_POST['id'];
        $nohp = $_POST['nohp'];

        $sql = mysqli_query($host, "UPDATE data_guru SET first_name='$first_name', last_name='$last_name', email='$email', password='$password', nohp_guru='$nohp' WHERE id='$id'");

        if ($sql) {

            return true;
        } else {

            echo "kesalahan saat update data";
        }
    }

    public function  EditProfileGuru_noPass($host)
    {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $nohp = $_POST['nohp'];

        $sql = mysqli_query($host, "UPDATE data_guru SET first_name='$first_name', last_name='$last_name', email='$email', nohp_guru='$nohp' WHERE id='$id'");

        if ($sql) {

            return true;
        } else {

            echo "kesalahan saat update data";
        }
    }

    public function Cek_ekstensi()
    {

        $Allowed = array("jpg", "png", "jpeg");

        $Getexstension = pathinfo($_FILES['gambar']['name']);

        if (in_array($Getexstension['extension'], $Allowed)) {

            return true;
        } else {

            return false;
        }
    }

    public function Editgambar($host)
    {

        $id = $_POST['id'];

        //nama direktori
        $nama_direktori = "../../dist/assets/userprofil/";

        $filegambar = $_FILES['gambar']['name'];

        $pathfile = $nama_direktori . $filegambar;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $pathfile)) {

            $sql = mysqli_query($host, "UPDATE data_guru SET gambar = '$filegambar' WHERE id='$id'");

            if ($sql) {

                return true;
            } else {

                echo "failed insert filegambar";
            }
        } else {

            echo "system erroe 404";
        }
    }

    public function Cekisigambar($host, $key)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password = '$key'");

        while ($row = mysqli_fetch_array($sql)) {

            $picture = $row['gambar'];
        }

        return $picture;
    }
}


class ajax_input_kelas
{

    public function input_class($host, $key, $nama_class, $class_code, $theme, $caption)
    {
        $email = array();
        $email = $this->email_user($host, $key); //call function email_user and get email

        $file_theme = $this->get_pict($theme); //get image

        $sql = mysqli_query($host, "INSERT INTO identitas_kelas (nama_kelas, kode_kelas, author, tema, caption, id_tema) VALUES ('$nama_class', '$class_code', '$email', '$file_theme', '$caption', '$theme')");

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function get_pict($theme)
    {
        if ($theme == 1) {
            $image = '../../dist/assets/img/mekanik/Satu.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }

        if ($theme == 2) {
            $image = '../../dist/assets/img/mekanik/Dua.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }

        if ($theme == 3) {
            $image = '../../dist/assets/img/mekanik/Tiga.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }

        if ($theme == 4) {
            $image = '../../dist/assets/img/mekanik/Empat.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }
        if ($theme == 5) {
            $image = '../../dist/assets/img/mekanik/Lima.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }
        if ($theme == 6) {
            $image = '../../dist/assets/img/mekanik/Enam.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }
        if ($theme == 7) {
            $image = '../../dist/assets/img/mekanik/Tuju.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }
        if ($theme == 8) {
            $image = '../../dist/assets/img/mekanik/Delapan.png';

            $image_file = addslashes(file_get_contents($image));

            return $image_file;
        }
    }

    public function email_user($host, $key)
    {
        $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password = '$key'");

        while ($row = mysqli_fetch_array($sql)) {
            $email = $row['email'];
        }

        return $email;
    }
}


class ajax_edit_class extends ajax_input_kelas
{

    public function edit_kelas($host, $key, $nama_class, $class_code, $theme, $caption)
    {
        $email = array();
        $email = $this->email_user($host, $key); //get email

        $file_theme = $this->get_pict($theme); //get pict

        $sql = mysqli_query($host, "UPDATE identitas_kelas SET nama_kelas='$nama_class', author='$email', caption='$caption', tema='$file_theme', id_tema='$theme' WHERE kode_kelas='$class_code'");

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function show_kelas($host, $key, $kode_kelas)
    {
        $email = array();
        $email = $this->email_user($host, $key); //get email

        $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author='$email'&&kode_kelas='$kode_kelas'");
        while ($row = mysqli_fetch_array($sql)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function delete_class($host, $key, $class_code)
    {
        $sql = mysqli_query($host, "DELETE FROM identitas_kelas WHERE kode_kelas='$class_code'");

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }
}

// By : ardhika yoviyanto
// controller classs

function main($pesan, $key, $host)
{

    $statistic = new statistic;

    if ($pesan == "Nama") {
        $Myname = array();
        $Myname = $statistic->nama_saya($host, $key);

        return $Myname; //returning to dist view
    }

    if ($pesan == "Show_class") {
        $rows = array();
        $rows = $statistic->show_all_class($host, $key);

        return $rows;
    }

    if ($pesan == "nohpsiswa") {

        if ($statistic->CekNohpsiswa($host, $key) == 1) {

            $nohpsiswa = $statistic->Nohpsiswa($host, $key);
            return $nohpsiswa;
        } else {

            return false;
        }
    }
}

function crud_data_class($host)
{

    $class_input = new ajax_input_kelas;
    $class_edit = new ajax_edit_class;

    if (isset($_POST['create_class'])) {
        $nama_class = $_POST['nama_class'];
        $class_code = $_POST['class_code'];
        $theme = $_POST['theme'];
        $caption = $_POST['caption'];

        //key
        $key = $_POST['key'];

        if ($class_input->input_class($host, $key, $nama_class, $class_code, $theme, $caption) == true) {
            header("location:../../dist/guru/index.php?success_create_class");
        } else {
            header("location:../../dist/guru/index.php?false_create_class");
        }
    }

    if (isset($_POST['edit_class'])) {
        $nama_class = $_POST['nama_class'];
        $class_code = $_POST['class_code'];
        $theme = $_POST['theme'];
        $caption = $_POST['caption'];

        //key
        $key = $_POST['key'];

        if ($class_edit->edit_kelas($host, $key, $nama_class, $class_code, $theme, $caption) == true) {
            header("location:../../dist/guru/index.php?success_edit_class");
        } else {
            header("location:../../dist/guru/index.php?false_edit_class");
        }
    }

    if (isset($_POST['delete_class'])) {
        $class_code = $_POST['class_code'];

        //key
        $key = $_POST['key'];

        if ($class_edit->delete_class($host, $key, $class_code) == true) {
            header("location:../../dist/guru/index.php?success_dlt_class");
        } else {
            header("location:../../dist/guru/index.php?false_dlt_class");
        }
    }
}

$statistic_update_profile = new statistic;

if (isset($_POST['update_profile'])) {

    $password = $_POST['password'];
    $gambar = $_FILES['gambar']['name'];
    $key = $_POST['key'];

    if ($password == NULL) {

        if ($statistic_update_profile->EditProfileGuru_noPass($host) == true) {

            if ($gambar == NULL) {

                header("location:../../DestroyedGuru.php");
            } else {

                if ($statistic_update_profile->Cek_ekstensi() == true) {

                    if ($statistic_update_profile->Editgambar($host) == true) {

                        header("location:../../DestroyedGuru.php");
                    } else {

                        echo "system error";
                    }
                } else {

                    //exstensi salah
                    header("location:../../dist/guru/index.php?exstensionfalse");
                }
            }
        }
    } else {

        if ($statistic_update_profile->EditProfileGuru_withPass($host) == true) {

            if ($gambar == NULL) {

                header("location:../../DestroyedGuru.php");
            } else {

                if ($statistic_update_profile->Cek_ekstensi() == true) {

                    if ($statistic_update_profile->Editgambar($host) == true) {

                        header("location:../../DestroyedGuru.php");
                    } else {

                        echo "system error";
                    }
                } else {

                    //exstensi salah
                    header("location:../../dist/guru/index.php?exstensionfalse");
                }
            }
        }
    }
} else if (isset($_POST['update_caption'])) {

    $class_code = $_POST['class_code'];
    $key = $_POST['key'];

    if ($statistic_update_profile->update_caption($host, $class_code) == true) {

        header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");
    }
}

crud_data_class($host);
