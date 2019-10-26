<?php require_once 'MODEL/Pagination.php'; ?>
<?php include_once("header.php")
?>
<?php include_once("nav.php")?>
<?php
    include_once("MODEL/book.php");
    // $book->display();
    $ls = Book::getList(); //vi ham getList la static gọi thông qua lớp  chứ ko qua đối tượng đc
    //addBook la name cua nút
    $lsFromFile = Book::getListFromFile();
   
    $arr;
    if (isset($_GET['nuttimkiem'])) {
      $result = array();
      $search = $_GET['timkiem'];
      if (empty($search)) {
        echo "Yeu cau nhap du lieu vao o trong";
      }
      else{
        foreach($lsFromFile as $key => $value){
        
          if(strpos($value->title,$_REQUEST['timkiem'])!=0||strpos($value->author,$_REQUEST['timkiem'])!=0||strcasecmp(trim($value->year),$_REQUEST['timkiem'])==0){
            array_push($result, $value);
          }
        }
      }
    }
    // if (isset($_REQUEST["addBook"])) {
    //   $id = $_REQUEST["id"];
    //   $title = $_REQUEST["title"];
    //   $price = $_REQUEST["price"];
    //   $author = $_REQUEST["author"];
    //   $year = $_REQUEST["year"];
    //   //$content = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;		
    //   Book::AddToFile($content,$id);
      
    // }
    if (isset($_REQUEST["addBook"])) {
      $id = $_REQUEST["idBook"];
      $title = $_REQUEST["title"];
      $price = $_REQUEST["price"];
      $author = $_REQUEST["author"];
      $year = $_REQUEST["year"];
      //$content = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;		
      Book::addBookDB($id,$title,$price,$author,$year);
      
    }
    if (isset($_REQUEST["delBook"])) {
          
          Book::delBookDB($_REQUEST["idBook"]);
      
    }
    if(isset($_REQUEST["editBook"])){
        $id    = $_REQUEST['idBook'];
        $title = $_REQUEST['title'];
        $price = $_REQUEST['price'];
        $author= $_REQUEST['author'];
        $year  = $_REQUEST['year'];
        // $book = new Book($id,$title,$price,$author,$year);
        Book::editBookDB($id, $title,$price,$author,$year);
    }
    if (isset($_GET["page"]) && $_GET['page'] != "") {
      $page  = $_GET["page"];
      $lsFromFile = Book::getBookOfPage($page);
    } else {
      $page = 1;
      $lsFromFile = Book::getBookOfPage(1);
    }
    $lsFromDB= Book::getListFromDB();

       
?>

<div class="row">
  <div class="col-6">
    <form action="" method="GET">
      <div class="form-group">
        <input type="text" name="timkiem" placeholder="Search" value="<?php echo $_GET["timkiem"] ??"" ?>">  
        <button type="submit" name="nuttimkiem"><i class="fa fa-search"></i></button>
        
      </div>
    </form>
  </div>
  <div class="col-6">
    <button style="float:right; margin-bottom:10px;" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addBook"><i class="fas fa-plus-circle"></i> Thêm</button>
    
      <div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <fieldset>
                  <div class="form-group d-flex">
                      <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                      <div class="col-md-10">
                        <input id="id" name="idBook" type="text" placeholder="Id" class="form-control input-md">
                      </div>
                    </div>
                    <div class="form-group d-flex">
                      <label class="pt-1 col-md-2 control-label" for="Title">Title</label>
                      <div class="col-md-10">
                        <input id="Title" name="title" type="text" placeholder="Title Book" class="form-control input-md">
                      </div>
                    </div>
                    <div class="form-group d-flex">
                      <label class="pt-1 col-md-2 control-label" for="Title">Price</label>
                      <div class="col-md-10">
                        <input id="Price" name="price" type="text" placeholder="Price" class="form-control input-md">
                      </div>
                    </div>
                    <!-- Select Basic -->
                    <div class="form-group d-flex">
                      <label class="pt-1 col-md-2 control-label" for="Year">Year</label>
                      <div class="col-md-10">
                        <select id="Year" name="year" class="form-control">
                          <option value="2019">2019</option>
                          <option value="2018">2018</option>
                          <option value="2017">2017</option>
                          <option value="2016">2016</option>
                          <option value="2015">2015</option>
                          <option value="2014">2014</option>
                          <option value="2013">2013</option>
                          <option value="2012">2012</option>
                          <option value="2011">2011</option>
                          <option value="2010">2010</option>
                        </select>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group d-flex">
                      <label class="pt-1 col-md-2 control-label" for="Author">Author</label>
                      <div class="col-md-10">
                        <input id="Author" name="author" type="text" placeholder="Author" class="form-control input-md">

                      </div>
                    </div>
					      </fieldset>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary" name="addBook">Lưu</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    
  </div>
  
</div>

<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr align="center">
      <th scope="col">STT</th>
      <th scope="col">Tiêu Đề</th>
      <th scope="col">Tác Giả</th>
      <th scope="col">Giá</th>
      <th scope="col">Năm</th> 
      <th scope="col">Thao tác</th>
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
      <tr align="center">
        <td><?php echo $value->id?></td>
        <td><?php echo $value->title?></td>
        <td><?php echo $value->author?></td>
        <td><?php echo $value->price?></td>    
        <td><?php echo $value->year?></td>
        <td>
              <button type="button" data-toggle="modal" data-target="<?php echo "#editBook".$value->id; ?>" class="btn btn-outline-warning"><i class="far fa-edit"></i> Sửa</button>
              <div class="modal fade" id="<?php echo "editBook".$value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="" method="post">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin sách : <?php echo "$value->title";?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <fieldset>
                          <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                              <div class="col-md-10">
                                <input id="id" name="idBook" type="text" disabled value="<?php echo "$value->id";?>" class="form-control input-md">
                              </div>
                            </div>
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Title">Title</label>
                              <div class="col-md-10">
                                <input id="Title" name="title" type="text" value="<?php echo "$value->title";?>" class="form-control input-md">
                              </div>
                            </div>
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Title">Price</label>
                              <div class="col-md-10">
                                <input id="Title" name="price" type="text" value="<?php echo "$value->price";?>" class="form-control input-md">
                              </div>
                            </div>
                            <!-- Select Basic -->
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Year">Year</label>
                              <div class="col-md-10">
                                <select id="Year" name="year" class="form-control">
                                  
                                  <option  value="2019">2019</option>
                                  <option  value="2018">2018</option>
                                  <option  value="2017">2017</option>
                                  <option  value="2016">2016</option>
                                  <option  value="2015">2015</option>
                                  
                                </select>
                              </div>
                            </div
                            <!-- Text input-->
                            <div class="form-group d-flex">
                              <label class="pt-1 col-md-2 control-label" for="Author">Author</label>
                              <div class="col-md-10">
                                <input id="Author" name="author" type="text" value="<?php echo "$value->author";?>" class="form-control input-md">
                              </div>
                            </div>
                        </fieldset>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="idBook" value="<?php echo "$value->id"; ?>" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" name="editBook">Lưu</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              
              <button type="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="<?php echo "#delBook".$value->id; ?>"><i class="far fa-trash-alt"></i> Xóa</button>
              <div class="modal fade" id="<?php echo "delBook".$value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="" method="get">  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa: <?php echo "$value->title"?> ?</h5>
                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    
                    <div class="modal-footer">
                      <input type="hidden" name="idBook" value="<?php echo "$value->id"; ?>" />
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                      <button type="submit" class="btn btn-primary" name="delBook">Xóa</button>
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
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?php echo "?page=".($_GET["page"]-1); ?>">Previous</a>
        </li>
        <?php
        $limit = 5;
        $listBook = Book::getListFromFile();

        $currentPage = (int) $_GET["page"];
        //Tong so trang hien thi
        $total_pages = ceil(sizeof($listBook) / $limit);
        for ($i = 1; $i <= $total_pages; $i++) {
            # code...
            if ($i == $currentPage) {
                ?>
                <li class='page-item active'><a class='page-link' href="<?php echo "?page=$i"; ?>"><?php echo $i; ?></a></li>
            <?php
                } else {
                    ?>
                <li class='page-item'><a class='page-link' href="<?php echo "?page=$i"; ?>"><?php echo $i; ?></a></li>
        <?php
            }
        }
        ?>

        <li class="page-item">
            <a class="page-link" href="<?php echo "?page=".($_GET["page"]+1); ?>">Next</a>
        </li>
    </ul>
</nav>


<?php include_once("footer.php")?>