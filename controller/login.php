<?php
    include '../config/config.php';

    class login_guru{
        private $hasil;
        
        public function GetIpAdress(){

            //whether ip is from share internet
            if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            
            }
            //whether ip is from proxy
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
            }
            //whether ip is from remote address
            else{
                
                $ip_address = $_SERVER['REMOTE_ADDR'];
            
            }

            return $ip_address;

        }

        public function GetLocation(){

            // $ip = $_SERVER['REMOTE_ADDR'];

            // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

            // return $details->city;

        }

        public function GetBrowser(){

            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";
        
            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }
            elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }
            elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }
        
            // Next get the name of the useragent yes seperately and for good reason
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }
            elseif(preg_match('/Firefox/i',$u_agent))
            {
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }
            elseif(preg_match('/Chrome/i',$u_agent))
            {
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }
            elseif(preg_match('/Safari/i',$u_agent))
            {
                $bname = 'Apple Safari';
                $ub = "Safari";
            }
            elseif(preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Opera';
                $ub = "Opera";
            }

        
            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }
        
            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }
                else {
                    $version= $matches['version'][1];
                }
            }
            else {
                $version= $matches['version'][0];
            }
        
            // check if we have a number
            if ($version==null || $version=="") {$version="?";}
        
            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );

        }


        public function inisialisasi($email, $password, $host){

            session_start();

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE email='$email' && password='$password'");
            
            $this->hasil=mysqli_num_rows($sql);

            if($this->hasil == 1){
                
                $_SESSION['key'] = $password;

                $browswer = $this->GetBrowser();
                $ip = $this->GetIpAdress();
                $location = "indonesia";

                $updateData = mysqli_query($host, "UPDATE data_guru SET browser='$browswer[name]', ip='$ip', location='$location' WHERE email='$email' AND password='$password'");

                $sess_Entered = mysqli_query($host, "INSERT INTO sessionguru (SessionId, email) VALUES ('$password', '$email')");

                header("location:../dist/guru/index.php?success");

            }else{
                
                header("location:../login.php?fail");

            }
        }
        
    }

    class login_siswa{
        private $hasil;

        public function GetIpAdress(){
            if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
                }  
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
            }  
        //whether ip is from the remote address  
            else{  
                    $ip = $_SERVER['REMOTE_ADDR'];  
            }  
            return $ip;  

        }

        public function GetLocation(){

            $ip = $this->GetIpAdress();

            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

            return $details->city;

        }

        public function GetBrowser(){

            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";
        
            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }
            elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }
            elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }
        
            // Next get the name of the useragent yes seperately and for good reason
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }
            elseif(preg_match('/Firefox/i',$u_agent))
            {
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }
            elseif(preg_match('/Chrome/i',$u_agent))
            {
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }
            elseif(preg_match('/Safari/i',$u_agent))
            {
                $bname = 'Apple Safari';
                $ub = "Safari";
            }
            elseif(preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Opera';
                $ub = "Opera";
            }
        
            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }
        
            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }
                else {
                    $version= $matches['version'][1];
                }
            }
            else {
                $version= $matches['version'][0];
            }
        
            // check if we have a number
            if ($version==null || $version=="") {$version="?";}
        
            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );

        }


        public function inisialisasi($email, $password, $host){
            
            session_start();

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email' && password='$password' && confirm=1");
            
            $this->hasil = mysqli_num_rows($sql);

            if($this->hasil == 1){

                $_SESSION['q'] = $password;

                $browswer = $this->GetBrowser();
                $ip = $this->GetIpAdress();
                $location = $this->GetLocation();

                $updateData = mysqli_query($host, "UPDATE data_siswa SET browser='$browswer[name]', ip='$ip', location='$location' WHERE email='$email' AND password='$password'");

                $sess_Entered = mysqli_query($host, "INSERT INTO sessionsiswa (SessionId, email) VALUES ('$password', '$email')");

                header("location:../dist/students/index.php");
            
            }else{
                header("location:../login.php?fail");
            }
        }
    }


    function main($host){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];

        if($level == "Teachers"){
            $login_guru = new login_guru;
            $login_guru->inisialisasi($email, $password, $host);
        }else{
            $login_siswa = new login_siswa;
            $login_siswa->inisialisasi($email, $password, $host);
        }
    }

    main($host);
?>