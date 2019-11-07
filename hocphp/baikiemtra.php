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
    include_once("MODEL/tag.php");
    // $book->display();
    $lsFromDB= Contact::getListContactFromDB();
    $lsTag = Tag:: getListTagFromDB();
    $countContact = Contact:: CountContactDB();
    $keyWord = null;
    if (isset($_GET['timkiem'])) {
      $result= array();
      $keyWord = $_REQUEST['timkiem'];
      if(empty($keyWord)){
        echo "<h1 style='color:red'>Bạn cần nhập dữ liệu để tìm kiếm</h1>";
      }else{
        $result = Contact::getListSearchContact($keyWord);
      }
      
    }
    if (isset($_REQUEST["addContact"])) {
      $idcontact = $_REQUEST["idcontact"];
      $ten = $_REQUEST["ten"];
      $email = $_REQUEST["email"];
      $sodienthoai = $_REQUEST["sodienthoai"];
      //$content = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;		
      Contact::addContactDB($idcontact,$ten,$email,$sodienthoai);
      
    }
    if (isset($_REQUEST["delContact"])) {
          
      Contact::delContactDB($_REQUEST["idcontact"]);
  
    }
    if(isset($_REQUEST["editContact"])){
        $idcontact = $_REQUEST['idcontact'];
        $ten = $_REQUEST['ten'];
        $email = $_REQUEST['email'];
        $sodienthoai= $_REQUEST['sodienthoai'];
        Contact::editContactDB($idcontact, $ten, $email, $sodienthoai);
    }
    if (isset($_REQUEST["addTag"])) {
      $tentag = $_REQUEST["tentag"];
      //$content = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;		
      Tag::addTagDB($tentag);
      
    }
?>
 <div class="contact">
   <div class="row">
      <div class="col-3">
          <h3 style="color: #5f6368; "><i class="fas fa-bars" style="padding: 10px"></i><img src="images/contact.png" alt="" style="width:15%">Danh bạ</h3>
          <button style="float:left; margin-bottom:10px;" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addContact"><i class="fas fa-plus-circle"></i>Tạo liên hệ</button>
          <div class="vertical-menu">
            <a href="#" class="active"><i class="far fa-user"></i>   Danh bạ   (<?php echo $countContact?>)  </a>
            <a href="#"><i class="fas fa-history"></i>   Thường xuyên liên hệ</a>
            <a href="#"><i class="far fa-clone"></i>  Liên hệ trùng lặp</a>
            <hr>
            <a href="#"><i class="fas fa-chevron-up"></i>  Nhãn</a>
            <?php 
                foreach ($lsTag as  $key => $value) {
                  ?>
                  <a href="#" style="margin-left: 20px;"><i class="fas fa-tags" style="margin-right: 7px;"></i><?php echo  $value->tentag?></a>
                  <?php }?>

            <a href="#" data-toggle="modal" data-target="#addTag"><i class="fas fa-plus"></i>  Tạo nhãn</a>
            <div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="" method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Thêm mới nhãn</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <fieldset>
                        
                          <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Tên nhãn</label>
                            <div class="col-md-10">
                              <input id="Title" name="tentag" type="text" placeholder="Tên nhãn mới" class="form-control input-md">
                            </div>
                          </div>
                          
                          <!-- Text input-->
                      </fieldset>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                      <button type="submit" class="btn btn-primary" name="addTag">Lưu</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
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
                            <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                            <div class="col-md-10">
                              <input id="id" name="idcontact" type="text" placeholder="ID Contact" class="form-control input-md">
                            </div>
                          </div>
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
                <th scope="col">Thao tác</th>
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
                  <td><input type="checkbox"><?php echo $value->idcontact?></td>
                  <td><?php echo $value->ten?></td>
                  <td><?php echo $value->email?></td>
                  <td><?php echo $value->sodienthoai?></td>
                  <td>
              <button type="button" data-toggle="modal" data-target="<?php echo "#editContact".$value->idcontact; ?>" class="btn btn-outline-success"><i class="far fa-edit"></i></button>
              <div class="modal fade" id="<?php echo "editContact".$value->idcontact; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="" method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin liên lạc : <?php echo "$value->ten";?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <fieldset>
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                              <div class="col-md-10">
                                <input id="i" name="idcontact" type="text" disabled value="<?php echo "$value->idcontact";?>" class="form-control input-md">
                              </div>
                            </div>
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Title">Tên</label>
                              <div class="col-md-10">
                                <input id="Title" name="ten" type="text" value="<?php echo "$value->ten";?>" class="form-control input-md">
                              </div>
                            </div>
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Title">Email</label>
                              <div class="col-md-10">
                                <input id="Title" name="email" type="text" value="<?php echo "$value->email";?>" class="form-control input-md">
                              </div>
                            </div> 
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Author">SĐT</label>
                              <div class="col-md-10">
                                <input id="Author" name="sodienthoai" type="text" value="<?php echo "$value->sodienthoai";?>" class="form-control input-md">
                              </div>
                            </div>
                        </fieldset>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="idcontact" value="<?php echo "$value->idcontact"; ?>" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="editContact">Lưu</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              
              <button type="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="<?php echo "#delContact".$value->idcontact; ?>"><i class="far fa-trash-alt"></i></button>
              <div class="modal fade" id="<?php echo "delContact".$value->idcontact; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="" method="get">  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa: <?php echo "$value->ten"?> ?</h5>
                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    
                    <div class="modal-footer">
                      <input type="hidden" name="idcontact" value="<?php echo "$value->idcontact"; ?>" />
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                      <button type="submit" class="btn btn-primary" name="delContact">Xóa</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
                  </td>
                </tr>
              <?php }?>
            
            </tbody>
          </table>
        </div>
    </div>
</div>
 
<!-- //phân trang -->



<?php include_once("footer.php")?>
