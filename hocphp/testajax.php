<?php 
   include_once("MODEL/user.php");
   include_once("MODEL/book.php");
   $userName = $_REQUEST["username"];
//    $user = new User($userName, "12345", "Phuc Phon");
    $lsFromFile = Book::getListFromFile();
//    $jsonUser = json_encode($user);
//    echo $jsonUser;
?>
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
      foreach ($lsFromFile as  $key => $value) {
      ?>   
      <tr align="center">
        <td><?php echo $value->id?></td>
        <td><?php echo $value->title?></td>
        <td><?php echo $value->author?></td>
        <td><?php echo $value->price?></td>    
        <td><?php echo $value->year?></td>
        <td>
            <button type="button" data-toggle="modal" data-target="<?php echo "#editBook".$value->id; ?>" class="btn btn-outline-warning"><i class="far fa-edit"></i> Sửa</button>
            <button type="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="<?php echo "#deleteBook".$value->id; ?>"><i class="far fa-trash-alt"></i> Xóa</button>
        </td>  
    </tr> 
    <?php }?> 
  </tbody>
</table>  