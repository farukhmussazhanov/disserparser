<?php
//require "autoload.php";

class Data
{
    public static function insertData($type,$img,$text)
    {
//        $current_timestamp = date('Y-m-d H:i:s');
//        $status = '1';
        $pdo = DbConfig::getInstance();
        $sql = "INSERT INTO data(type,img,text)
                           VALUES
                           (:type,
                            :img,
                           :text)";
        $q = $pdo->getConnection()->prepare($sql);
        $q->bindParam(':type',$type);
        $q->bindParam(':img',$img,PDO::PARAM_LOB);
        $q->bindParam(':text',$text);
//        $q->bindParam(':REQUEST_STATUS',$status);
//        $q->bindParam(':created_at',$current_timestamp);
        return ($q->execute()) ? $pdo->getConnection()->lastInsertId() : 0;
//        $this->GLOBAL_ID ;

    }

}