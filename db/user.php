<?php
include_once('koneksi.php');

class user extends koneksi{

    function showData(){
        $sql = "SELECT * FROM user WHERE deleted_at IS NULL";
        $data = $this->koneksi->prepare($sql);
        $data->execute();
        return $data;
    } 

    function insertData($name, $email, $password, $role){
        try{
            $now = date("Y-m-d H:i:s");
            $hash_pass = password_hash($password,PASSWORD_DEFAULT);

            $sql = "INSERT INTO user(name, email, password, role, created_at) VALUES(:name, :email, :password, :role, :created_at)";
            $stmt = $this->koneksi->prepare($sql);
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password',$hash_pass);
            $stmt->bindParam(':role',$role);
            $stmt->bindParam(':created_at',$now);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function detailData($data){
        try {
            $sql = "SELECT id, name, email, role, profile_image FROM user WHERE id=:id";
            $stmt = $this->koneksi->prepare($sql);
            $stmt->bindParam(":id", $data);
            $stmt->execute();
            $stmt->bindColumn(1, $this->id);
            $stmt->bindColumn(2, $this->name);
            $stmt->bindColumn(3, $this->email);
            $stmt->bindColumn(4, $this->role);
            $stmt->bindColumn(5, $this->profile_image);
            $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) :
                return true;
            else :
                return false;
            endif;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function updateData($data,$name,$email,$role){
        try{
            $sql = "UPDATE user SET name=:name,email=:email, role=:role WHERE id=:id";
            $stmt = $this->koneksi->prepare($sql);
            $stmt->bindParam(":name",$name);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":role",$role);
            $stmt->bindParam(":id",$data);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function deleteData($data){
        try{
            $sql = "UPDATE user SET deleted_at=:deleted_at WHERE id=:id";
            $stmt=$this->koneksi->prepare($sql);
            $stmt->bindParam(':deleted_at', date("Y-m-d H:i:s"));
            $stmt->bindParam(':id',$data);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function showDeleteData(){
        $sql = "SELECT * FROM user WHERE deleted_at IS NOT NULL";
        $data = $this->koneksi->prepare($sql);
        $data->execute();
        return $data;
    }

    function restoreData($data){
        $null = null;
        try{
            $sql = "UPDATE user SET deleted_at=:deleted_at WHERE id=:id";
            $stmt=$this->koneksi->prepare($sql);
            $stmt->bindParam(':deleted_at',$null);
            $stmt->bindParam(':id',$data);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function updateProfile($id, $name, $email, $profile_image){
        $target_dir = 'upload/admin_images/';
        $target_file = $target_dir . basename($profile_image['name']);

        try{
            $sql = "SELECT profile_image FROM user WHERE id=:id";
            $stmt = $this->koneksi->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->profile_image);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (file_exists($target_dir . $data['profile_image'])) {
                unlink($target_dir . $data['profile_image']);
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        move_uploaded_file($profile_image['tmp_name'], $target_file);

        try{
            $sql = "UPDATE user SET name=:name, email=:email, profile_image=:profile_image WHERE id=:id";
            $data = $this->koneksi->prepare($sql);
            $data->bindParam(':name',$name);
            $data->bindParam(':email',$email);
            $data->bindParam(':profile_image',$profile_image['name']);
            $data->bindParam(':id',$id);
            $data->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}