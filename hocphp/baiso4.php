<?php include_once("header.php")?>
<?php include_once("nav.php")?>
<?php 
    include_once("MODEL/book.php");
    $book = new Book(1,50,"PHP OOP","FONEE",2019);
    // $book->display();
    // $ls = Book::getList();
    // Book::getListFromFile();
    $lsFromFile = Book::getListFromFile();
    $ls = Book::getList();
    $keyWord = null;
    $keyWord = $_REQUEST['search'];
    $books = Book::getListTimKiem($keyWord);
    if (isset($_REQUEST["addBook"])) {
      $id = $_REQUEST["id"];
      $title = $_REQUEST["Title"];
      $price = $_REQUEST["Price"];
      $author = $_REQUEST["Author"];
      $year = $_REQUEST["Year"];
      $content = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;
      Book::addToFile($content);
      //echo "<meta http-equiv='refresh' content='0'>";
    }
    if (isset($_REQUEST["delBook"])) {
        $id = $_REQUEST["id"];
        $title = $_REQUEST["Title"];
        $price = $_REQUEST["Price"];
        $author = $_REQUEST["Author"];
        $year = $_REQUEST["Year"];
        Book::deleteBoook($id, $title, $price, $author,$year);
        //echo "<meta http-equiv='refresh' content='0'>";
      }
?>
<form action="" method="GET">
        <div class="form-group">
            <input class="form-control" name="search" value="<?php echo $keyWord; ?>"  style="max-width: 200px; display:inline-block;" placeholder="Search">
            <button type="submit" class="btn btn-default" style="margin-left:-50px"><i class="fas fa-search"></i></button>
        </div>
</form>
<button type="button" class="btn btn-outline-primary" style="float: right;"  data-toggle="modal" data-target="#addBook"><i class="fas fa-plus"></i>Thêm</button>
<!-- Modal -->
<div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm sách</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                            <div class="col-md-10">
                                <input id="id" name="id" type="text" placeholder="ID" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Title</label>
                            <div class="col-md-10">
                                <input id="Title" name="Title" type="text" placeholder="Title" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Price</label>
                            <div class="col-md-10">
                                <input id="Title" name="Price" type="text" placeholder="Price" class="form-control input-md">
                            </div>
                        </div>
                        <!-- Select Basic -->
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Year">Year</label>
                            <div class="col-md-10">
                                <select id="Year" name="Year" class="form-control">
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
                                <input id="Author" name="Author" type="text" placeholder="Author" class="form-control input-md">

                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="addBook" class="btn btn-primary">Lưu thay đổi</button>
                </div>
        </form>
    </div>
</div>
</div>
<table class="table">

  <thead align="center" class="thead-dark">
    <tr>
        <th>STT</th>
        <th>Title</th>
        <th>Price</th>
        <th>Author</th>
        <th>Year</th>
        <th>Thao tác</th>
    </tr>
  </thead>
  <tbody align="center">
  <?php 
     foreach( $books as $stt=> $value){?>
        <tr>
        <th><?php echo $stt?></th>
        <td><?php echo $value->price?></td>
        <td><?php echo $value->title?></td>
        <td><?php echo $value->author?></td>
        <td><?php echo $value->year?></td>
        <td>
          <button type="button" class="btn btn-outline-success"  data-toggle="modal" data-target="#editBook"><i class="fas fa-edit"></i>Sửa</button>
          <button type="submit"  class="btn btn-outline-danger" name="delBook"><i class="fas fa-trash-alt"></i>Xóa</button>
        </td>
      </tr>
     <?php }?>
  </tbody>
</table>
<div class="modal fade" id="editBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa sách</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">ID</label>
                            <div class="col-md-10">
                                <input id="id" name="id" type="text" placeholder="ID" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Title</label>
                            <div class="col-md-10">
                                <input id="Title" name="Title" type="text" placeholder="Title" class="form-control input-md">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Title">Price</label>
                            <div class="col-md-10">
                                <input id="Title" name="Price" type="text" placeholder="Price" class="form-control input-md">
                            </div>
                        </div>
                        <!-- Select Basic -->
                        <div class="form-group d-flex">
                            <label class="pt-1 col-md-2 control-label" for="Year">Year</label>
                            <div class="col-md-10">
                                <select id="Year" name="Year" class="form-control">
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
                                <input id="Author" name="Author" type="text" placeholder="Author" class="form-control input-md">

                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="editBook" class="btn btn-primary">Lưu thay đổi</button>
                </div>
        </form>
    </div>
</div>
<?php include_once("footer.php")?>