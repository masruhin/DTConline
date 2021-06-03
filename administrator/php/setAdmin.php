<?php
@include '../../config/config.php';

class setAdmin
{

    public function ViewProfil($host)
    {

        $sql = mysqli_query($host, "SELECT *FROM admin");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function UpdateDataWithPass($host)
    {

        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = mysqli_query($host, "UPDATE admin SET nama = '$nama', username='$username', password='$password' WHERE id=1");

        if ($sql) {

            return true;
        } else {

            return false;
        }
    }

    public function UpdateDataNoPass($host)
    {

        $nama = $_POST['nama'];
        $username = $_POST['username'];

        $sql = mysqli_query($host, "UPDATE admin SET nama = '$nama', username='$username' WHERE id=1");

        if ($sql) {

            return true;
        } else {

            return false;
        }
    }

    public function Cek_ekstensi_Gambar()
    {

        $Allowed = array("jpg", "png", "jpeg");

        $Getexstension = pathinfo($_FILES['gambar']['name']);

        if (in_array($Getexstension['extension'], $Allowed)) {

            return true;
        } else {

            return false;
        }
    }

    public function EditGambar($host)
    {

        //nama direktori
        $nama_direktori = "../dist/img/";

        $filegambar = $_FILES['gambar']['name'];

        $pathfile = $nama_direktori . $filegambar;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $pathfile)) {

            $sql = mysqli_query($host, "UPDATE admin SET gambar = '$filegambar' WHERE id=1");

            if ($sql) {

                return true;
            } else {

                echo "failed insert filegambar";
            }
        } else {

            echo "system erroe 404";
        }
    }
}

$setAdmin = new setAdmin;

if (isset($_POST['edit_admin'])) {

    if ($_POST['password'] ==  NULL) {

        if ($setAdmin->UpdateDataNoPass($host) == true) {

            if ($_FILES['gambar']['name'] == NULL) {

                header("location:../setAdmin.php?edit_ok");
            } else {

                if ($setAdmin->Cek_ekstensi_Gambar() == true) {

                    if ($setAdmin->EditGambar($host) == true) {

                        header("location:../setAdmin.php?edit_ok");
                    } else {

                        echo "Query Insert File Gagal";
                    }
                } else {

                    header("location:../setAdmin.php?exstensi");
                }
            }
        } else {

            echo "Query Gagal";
        }
    } else {

        if ($setAdmin->UpdateDataWithPass($host) == true) {

            if ($_FILES['gambar']['name'] == NULL) {

                header("location:../setAdmin.php?edit_ok");
            } else {

                if ($setAdmin->Cek_ekstensi_Gambar() == true) {

                    if ($setAdmin->EditGambar($host) == true) {

                        header("location:../setAdmin.php?edit_ok");
                    } else {

                        echo "Query edit gambar gagal";
                    }
                } else {

                    header("location:../setAdmin.php?exstensi");
                }
            }
        }
    }
}
