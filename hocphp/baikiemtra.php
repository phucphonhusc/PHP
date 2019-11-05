<?php include_once("header.php")
?> <style>
  .vertical-menu {
  width: 100%;
  margin-top: 100px;
}

.vertical-menu a {
  background-color: white;
  color: black;
  display: block;
  padding: 12px;
  text-decoration: none;
}

.vertical-menu a:hover {
  background: #e8f0fe;
  border-radius: 50px;
}

.vertical-menu a.active {
 background: #e8f0fe;
  color: #1a73e8;
  border-radius: 50px;
}
</style><?php
?>
<?php include_once("nav.php")?>
<?php
    include_once("MODEL/contact.php");
    // $book->display();
    $lsFromDB= Contact::getListFromDB();
    $keyWord = null;
    if (isset($_GET['timkiem'])) {
      $result= array();
      $keyWord = $_REQUEST['timkiem'];
      if(empty($keyWord)){
        echo "Bạn cần nhập dữ liệu để tìm kiếm";
      }else{
        $result = Contact::getListSearch($keyWord);
      }
      
    }
    if (isset($_REQUEST["addContact"])) {
      $ten = $_REQUEST["ten"];
      $email = $_REQUEST["email"];
      $sodienthoai = $_REQUEST["sodienthoai"];
      //$content = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;		
      Contact::addContactDB($ten,$email,$sodienthoai);
      
    }
?>
 <div class="contact">
   <div class="row">
      <div class="col-3">
          <h3 style="color: #5f6368; "><i class="fas fa-bars" style="padding: 10px"></i><img src="images/contact.png" alt="" style="width:15%">Danh bạ</h3>
          <button style="float:left; margin-bottom:10px;" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addContact"><i class="fas fa-plus-circle"></i>Tạo liên hệ</button>
          <div class="vertical-menu">
            <a href="#" class="active"><i class="far fa-user"></i>   Danh bạ</a>
            <a href="#"><i class="fas fa-history"></i>   Thường xuyên liên hệ</a>
            <a href="#"><i class="far fa-clone"></i>  Liên hệ trùng lặp</a>
            <hr>
            <a href="#"><i class="far fa-clone"></i>  Nhãn</a>
            <a href="#"><i class="fas fa-tags"></i>  FPT</a>
            <a href="#"><i class="fas fa-tags"></i>  Khoa CNTT</a>
            <a href="#"><i class="fas fa-tags"></i>  Facbook</a>
            <a href="#"><i class="fas fa-tags"></i>  Xã hội</a>
            <a href="#"><i class="fas fa-plus"></i>  Tạo nhãn</a>
          </div>
            <div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="" method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Thêm mới liên lạc</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <fieldset>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Tên</label>
                            <div class="col-md-10">
                              <input id="id" name="ten" type="text" placeholder="Tên liên lạc" class="form-control input-md">
                            </div>
                          </div>
                          <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Email</label>
                            <div class="col-md-10">
                              <input id="Title" name="email" type="text" placeholder="Email" class="form-control input-md">
                            </div>
                          </div>
                          <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">SĐT</label>
                            <div class="col-md-10">
                              <input id="Title" name="sodienthoai" type="text" placeholder="Số điện thoại" class="form-control input-md">
                            </div>
                          </div>
                          
                          <!-- Text input-->
                      </fieldset>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                      <button type="submit" class="btn btn-primary" name="addContact">Lưu</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
      </div>
      <div class="col-9">
      <div class="row">
            <div class="col-12">
            <form action="" method="GET">
              <div class="form-group">
              <input class="form-control"  name="timkiem" style="max-width: 800px; display:inline-block;" placeholder="Tìm kiếm">
              <button type="submit" class="btn btn-default" style="margin-left:-50px"><i class="fas fa-search"></i></button>
              </div>
            </form>

            </div>
            
      </div>

          <table class="table">
            <thead class="">
              <tr style="color: #5f6368; ">
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                // if(isset($result)){
                //   $arr = $result;
                // }
                // else{
                //   $arr = $lsFromDB;
                // }
                
                foreach ($lsFromDB as  $key => $value) {
                ?>   
                <tr style="color: #202124; ">
                  <td><input type="checkbox"><?php echo $value->id?></td>
                  <td><?php echo $value->ten?></td>
                  <td><?php echo $value->email?></td>
                  <td><?php echo $value->sodienthoai?></td>
                </tr>
              <?php }?>
            
            </tbody>
          </table>
        </div>
    </div>
</div>
 
<!-- //phân trang -->



<?php include_once("footer.php")?>
