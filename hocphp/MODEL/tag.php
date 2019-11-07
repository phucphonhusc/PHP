<?php 
class Tag{
    var $idtag;
    var $tentag;
    function __construct($idtag, $tentag )
    {
        $this->idtag = $idtag;
        $this->tentag= $tentag;

    }
    static function connect(){
        //b1: tạo kết nối
        $con = new mysqli("localhost","root","","Contact");
        $con->set_charset("utf8");
        if($con->connect_error)
            die("Kết nối thất bại. Chi tiết:" .$con->connect_error);
       //  echo "<h1>Kết nối thành công!</h1>";
       //b2: thao tác vs csdl : crud
        return $con;
    }
    static function getListTagFromDB(){
       $con = Tag::connect();
       $sql = "SELECT * FROM tag ";
       $result = $con->query($sql);
       $lsTag = array();
       if($result->num_rows >0){
           while($row = $result->fetch_assoc()){
               $tag= new Tag($row["IdTag"],$row["TenTag"]);
               array_push($lsTag, $tag);
           }
       }
       //b3: giải phóng kết nối
       $con->close();
       return $lsTag;
   }
   static function addTagDB($tentag){
        $con = Tag::connect();
        $sql = "INSERT INTO tag (TenTag) VALUES ('$tentag')";
        // $result = $con->query($sql);
        if($con->query($sql)===TRUE){
            echo "Thêm thành công";
        }else{
            echo "Thêm thất bại". $con->connect_error;
        }
        $con->close();
    }
    static function delTagDB($idtag){
        $con = Tag::connect();
        $sql = "DELETE FROM tag  WHERE IdTag =$idtag" ;
        // echo $id;
        // $result = $con->query($sql);
        if($con->query($sql) === TRUE){
            echo "Xóa thành công";
        }else{
            echo "Xóa thất bại". $con->connect_error;
        }
            
        $con->close();
    }
    static function editTagDB($idtag, $tentag){
        $con = Tag::connect();
        $sql = "UPDATE tag SET TenTag='$tentag' WHERE IdTag= $idtag";
        // echo "kokok";
        // $result = $con->query($sql);
        if($con->query($sql) === TRUE){
            echo "Chỉnh sửa thành công";
        }else{
            echo "Chỉnh sửa thất bại". $con->connect_error;
        }
        $con->close();
    }    
    
}

?>