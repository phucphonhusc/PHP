<?php 
class User{
    var $userName; 
    var $passWord;
    var $fullName;
    function User($userName, $passWord, $fullName){
        $this->userName = $userName;
        $this ->passWord = $passWord;
        $this ->fullName = $fullName;
    }
    /** Xac nhan nguoi su dung
     * @param $userName : string ten dang nhap
     *  @param $passWord : string mat khau
     * @return user hoac null neu khong ton tai
     */

    static function authentication($userName, $passWord){
        if($userName == "phucphonhusc" && $passWord == "123"){
            return new User($userName , $passWord, "Phuc Phon");
        }
        else return null;
    }
}
?>