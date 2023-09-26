<?php
include_once('koneksi.php');

class login extends koneksi{
    function prosesLogin($email){
        $sql = "SELECT * FROM user WHERE email=:email";
        $data=$this->koneksi->prepare($sql);
        $data->bindParam(":email",$email);
        $data->execute();
        return $data;
    }

    function prosesForgotPassword($email){
        $hashPassword = password_hash("123456789",PASSWORD_DEFAULT);
        try{
            $sql = "UPDATE user SET password = :password WHERE email = :email";
            $data = $this->koneksi->prepare($sql);
            $data->bindParam(":password", $hashPassword);
            $data->bindParam(":email", $email);
            $data->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        
    }
}