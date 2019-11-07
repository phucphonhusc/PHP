<?php 
class Contact{
    var $idcontact;
    var $ten;
    var $email;
    var $sodienthoai;
    function __construct($idcontact,$ten,$email,$sodienthoai )
    {
        $this->idcontact = $idcontact;
        $this->ten=$ten;
        $this->email = $email;
        $this->sodienthoai = $sodienthoai;

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
    static function getListContactFromDB(){
       $con = Contact::connect();
       $sql = "SELECT * FROM contact ";
       $result = $con->query($sql);
       $lsContact = array();
       if($result->num_rows >0){
           while($row = $result->fetch_assoc()){
               $contact= new Contact($row["IdContact"],$row["Ten"],$row["Email"],$row["SoDienThoai"]);
               array_push($lsContact, $contact);
           }
       }
       //b3: giải phóng kết nối
       $con->close();
       return $lsContact;
   }
   static function addContactDB($idcontact,$ten, $email, $sodienthoai){
        $con = Contact::connect();
        $sql = "INSERT INTO contact (IdContact, Ten, Email, SoDienThoai) VALUES ('$idcontact','$ten','$email','$sodienthoai')";
        // $result = $con->query($sql);
        if($con->query($sql)===TRUE){
            echo "Thêm thành công";
        }else{
            echo "Thêm thất bại". $con->connect_error;
        }
        $con->close();
    }
    static function CountContactDB(){
        $con = Contact::connect();
        $sql = "SELECT COUNT(IdContact) as 'IdContact' FROM contact";
        $lsContact = array();
        $result = $con->query($sql);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $lsContact= $row["IdContact"];
            }
        }
        
        $con->close();
        return $lsContact;
    }
    static function getListSearchContact($search = null)
        {
            $con = Contact::connect();
            $sql = "SELECT * FROM contact";
            $result = $con->query($sql);
            $lsContact = array();
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    if (
                        strlen(strstr($row["IdContact"], $search)) || strlen(strstr($row["Ten"], $search)) ||
                        strlen(strstr($row["Email"], $search)) || strlen(strstr($row["SoDienThoai"], $search)) || $search == null
                    )
                    {
                    
                    $contact =  new Contact($row["IdContact"], $row["Ten"], $row["Email"], $row["SoDienThoai"]);
                    array_push($lsContact, $contact);
                    
                    }
                }
            }
            //B3: Giải phóng kết nối
            $con->close();  
            return $lsContact;
        }
        static function delContactDB($idcontact){
            $con = Contact::connect();
            $sql = "DELETE FROM contact  WHERE IdContact =$idcontact " ;
            // echo $id;
            // $result = $con->query($sql);
            if($con->query($sql) === TRUE){
                echo "Xóa thành công";
            }else{
                echo "Xóa thất bại". $con->connect_error;
            }
                
            $con->close();
        }
        static function editContactDB($idcontact, $ten, $email, $sodienthoai){
            $con = Contact::connect();
            $sql = "UPDATE contact SET Ten='$ten', Email='$email', SoDienThoai='$sodienthoai' WHERE IdContact= $idcontact";
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