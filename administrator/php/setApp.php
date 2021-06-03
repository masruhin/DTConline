<?php
@include '../../config/config.php';

class setApp
{

    public function ViewDataAplikasi($host)
    {

        $sql = mysqli_query($host, "SELECT *FROM tb_aplikasi");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function ViewLayoutDepan($host)
    {

        $sql = mysqli_query($host, "SELECT *FROM breadcrumb");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function ViewLayoutDepanForEdit($host, $id)
    {

        $sql = mysqli_query($host, "SELECT *FROM breadcrumb WHERE id='$id'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
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

    public function Cek_ekstensi_Icon()
    {

        $Allowed = array("ico", "jpg", "png", "jpeg");

        $Getexstension = pathinfo($_FILES['favicon']['name']);

        if (in_array($Getexstension['extension'], $Allowed)) {

            return true;
        } else {

            return false;
        }
    }

    public function EditGambar($host)
    {

        //nama direktori
        $nama_direktori = "../../dist/assets/img/";

        $filegambar = $_FILES['gambar']['name'];

        $pathfile = $nama_direktori . $filegambar;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $pathfile)) {

            $sql = mysqli_query($host, "UPDATE tb_aplikasi SET logo = '$filegambar' WHERE id=1");

            if ($sql) {

                return true;
            } else {

                echo "failed insert filegambar";
            }
        } else {

            echo "system erroe 404";
        }
    }

    public function EditFavicon($host)
    {

        //nama direktori
        $nama_direktori = "../../dist/assets/img/";

        $filegambar = $_FILES['favicon']['name'];

        $pathfile = $nama_direktori . $filegambar;

        if (move_uploaded_file($_FILES['favicon']['tmp_name'], $pathfile)) {

            $sql = mysqli_query($host, "UPDATE tb_aplikasi SET favicon = '$filegambar' WHERE id=1");

            if ($sql) {

                return true;
            } else {

                echo "failed insert favicon";
            }
        } else {

            echo "system erroe 404";
        }
    }

    public function UpdateIdentitasAplikasi($host)
    {

        $nama_app = $_POST['nama_app'];
        $copyright = $_POST['copyright'];

        if ($this->Cek_ekstensi_Gambar() == true) {

            if ($this->Cek_ekstensi_Icon() == true) {

                if ($this->EditGambar($host) == true) {

                    if ($this->EditFavicon($host) == true) {

                        $sql = mysqli_query($host, "UPDATE tb_aplikasi SET nama_app = '$nama_app', copyright='$copyright' WHERE id=1");

                        if ($sql) {

                            return true;
                        } else {

                            return false;
                        }
                    } else {

                        return false;
                    }
                } else {

                    return false;
                }
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public function UpdateGambarBreadcrumb($host, $id)
    {

        //nama direktori
        $nama_direktori = "../../dist/assets/breadcrumb/";

        $filegambar = $_FILES['gambar']['name'];

        $pathfile = $nama_direktori . $filegambar;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $pathfile)) {

            $sql = mysqli_query($host, "UPDATE breadcrumb SET gambar = '$filegambar' WHERE id='$id'");

            if ($sql) {

                return true;
            } else {

                echo "failed insert filegambar";
            }
        } else {

            echo "system erroe 404";
        }
    }

    public function UpdateBreadcrumb($host, $id)
    {

        $judul = $_POST['judul'];
        $subjudul = $_POST['subjudul'];

        if ($this->Cek_ekstensi_Gambar() == true) {

            if ($this->UpdateGambarBreadcrumb($host, $id) == true) {

                $sql = mysqli_query($host, "UPDATE breadcrumb SET judul='$judul', subjudul='$subjudul' WHERE id='$id'");

                if ($sql) {

                    return true;
                } else {

                    return false;
                }
            } else {

                return false;
            }
        } else {

            return false;
        }
    }
}

$setApp = new setApp;

if (isset($_POST['update_app'])) {

    if ($setApp->UpdateIdentitasAplikasi($host) == true) {

        header("location:../SetApp.php?update_app");
    } else {

        header("location:../SetApp.php?exstensi");
    }
} else

    if (isset($_POST['breadcrumb'])) {

    $id = $_POST['id'];

    if ($setApp->UpdateBreadcrumb($host, $id) == true) {

        header("location:../SetApp.php?update_app");
    } else {

        header("location:../SetApp.php?exstensi");
    }
}
