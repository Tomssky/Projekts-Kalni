<?php

class auth{

    var $db;
    var $email;
    var $pswd;
    var $messages = array();

    function __construct(){
        $this->db = new db();
    }

    function message($message){
        $this->messages[] = $message;
        return $this;
    }

    function loginTray(){
        if(isset($_SESSION['login_tray'])){
            $_SESSION['login_tray']++;
        }else{
            $_SESSION['login_tray'] = 0;
        }

        return $_SESSION['login_tray'];
    }

    function postValid(){

        if($this->loginTray() >= 10){
            $this->message('Pārsniegts autorizācijau skaits.');
        }

        if(isset($_POST["email"])){

            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                $this->email    = $_POST["email"];
                $this->pswd     = $_POST["password"];
                $this->valid = true;
            }else{
                $this->message('Nepareiz e-pastsa formāts');
            }
        }

        return $this;
    }

    function login(){
        
        if(isset($_POST['email'])){
            $this->postValid();

            if(count($this->messages) == 0){
                $auth = $this->db->getArrayFirst('SELECT `id`, `username`, `email`, `access` FROM `users` WHERE `email` = "'.$this->email.'" AND `password` = md5("'.$this->pswd.'")',true);

                if(isset($auth['id'])){
                    $_SESSION['auth'] = $auth;

                    header("Location: /");
                }else{
                    $this->message('Neizdevās autentificēties e-pasts vai parole ir nekorekta');
                }
            }
        }

        return false;
    }

    function access(){
        if(isset($_SESSION['auth']['access'])){
            return $_SESSION['auth']['access'];
        }
        
        return 1;
    }

    function logout(){
        session_destroy();
        header("Location: /");
    }

    function auth(){
        if(isset($_SESSION['auth']['id'])){
            return true;
        }

        return false;
    }

    function register(){ 

   }  
 }
?>