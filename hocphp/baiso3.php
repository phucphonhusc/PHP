<?php include_once("header.php")?>
<?php include_once("nav.php")?>
<?php 
    $masinhvien = $ho = $ten = $ngaysinh = $email ="";
    // var_dump($_SERVER);
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $masinhvien = $_REQUEST["txtMaSinhVien"];
        $ho = $_REQUEST["txtHoSinhVien"];
        $ten = $_REQUEST["txtTenSinhVien"];
        $ngaysinh = $_REQUEST["txtNgaySinh"];
        $email = $_REQUEST["txtemail"];
        //kiem tra email 
        $email = filter_var($email , FILTER_SANITIZE_EMAIL);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Ban da nhap email dung dinh dang";
        }
        else{
            echo "Ban da nhap email sai dinh dang";
        }
        if($_FILES["fileAnhDaiDien"]["tmp_name"]!=""){
            move_uploaded_file($_FILES["fileAnhDaiDien"]["tmp_name"],"upload/avatar.jpg");
        }
        // var_dump($_FILES);
        
    }
    
?>
<form  method="post" style="margin: 10px" enctype="multipart/form-data">
    <div>
        <div>
            <label for="">Ma sinh vien</label>           
        </div>
        <div>
            <input  required type="text" name="txtMaSinhVien" value="<?php echo $masinhvien?>">           
        </div>
        <div>
            <label for="">Ho sinh vien</label>           
        </div>
        <div>
            <input require type="text" name="txtHoSinhVien" value="<?php echo $ho?>">           
        </div>
        <div>
            <label  for="">Ten sinh vien </label>           
        </div>
        <div>
            <input required type="text" name="txtTenSinhVien" value="<?php echo $ten?>">           
        </div>
        <div>
            <label for="">Ngay sinh</label>           
        </div>
        <div>
            <input  required type="date" name="txtNgaySinh" value="<?php echo $ngaysinh?>">           
        </div>
        <div>
            <label for="">Email</label>           
        </div>
        <div>
            <input required type="email" name="txtemail" value="<?php echo $email?>">           
        </div>
        <div>
            <label for="">Anh dai dien</label>           
        </div>
        <div>
            <input  required type="file" name="fileAnhDaiDien" value="">           
        </div>
        <div>
            <input  required type="submit" name="btnLuu" value="LUU" style="margin-top: 10px; color: red">           
        </div>
    </div>
</form>
<?php include_once("footer.php")?>