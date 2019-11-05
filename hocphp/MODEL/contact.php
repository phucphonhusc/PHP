<?php 
class Contact{
    var $id;
    var $ten;
    var $email;
    var $sodienthoai;
    function __construct($id,$ten,$email,$sodienthoai )
    {
        $this->id = $id;
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
    static function getListFromDB(){
       $con = Contact::connect();
       $sql = "SELECT * FROM contact ";
       $result = $con->query($sql);
       $lsContact = array();
       if($result->num_rows >0){
           while($row = $result->fetch_assoc()){
               $contact= new Contact($row["ID"],$row["Ten"],$row["Email"],$row["SoDienThoai"]);
               array_push($lsContact, $contact);
           }
       }
       //b3: giải phóng kết nối
       $con->close();
       return $lsContact;
   }
   static function addContactDB($ten, $email, $sodienthoai){
        $con = Contact::connect();
        $sql = "INSERT INTO contact (Ten, Email, SoDienThoai) VALUES ('$ten','$email','$sodienthoai')";
        // $result = $con->query($sql);
        if($con->query($sql)===TRUE){
            echo "Thêm thành công";
        }else{
            echo "Thêm thất bại". $con->connect_error;
        }
        $con->close();
    }
    static function getListSearch($search = null)
        {
            $con = Contact::connect();
            $sql = "SELECT * FROM contact";
            $result = $con->query($sql);
            $lsContact = array();
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    if (
                        strlen(strstr($row["ID"], $search)) || strlen(strstr($row["Ten"], $search)) ||
                        strlen(strstr($row["Email"], $search)) || strlen(strstr($row["SoDienThoai"], $search)) || $search == null
                    )
                    {
                    
                    $contact =  new Contact($row["ID"], $row["Ten"], $row["Email"], $row["SoDienThoai"]);
                    array_push($lsContact, $contact);
                    
                    }
                }
            }
            //B3: Giải phóng kết nối
            $con->close();  
            return $lsContact;
        }
}

?>