<?php 
class Book{
    #properties
    var $id;
    var $title;
    var $price;
    var $author;
    var $year;
    #end properties
        #Construct function
    function __construct($id,  $title, $price, $author, $year)
    {
        $this->id=$id;
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
        $this->year = $year;
    }
    #Member function
    function display(){
        echo "Price : " . $this->price . "<br>";
        echo "Title : " . $this->title . "<br>";
        echo "Author : " . $this->author . "<br>";
        echo "Year : " . $this->year . "<br>";
    }
    #mod data 
    /**
     * lấy toàn bộ dữ liệu có trong csdl
     */
    static function getList(){
        $listBook = array();
        array_push($listBook, new Book(1,6,"a",10,"foneee", 2020));
        array_push($listBook, new Book(2,7,"b",20,"foneee2", 2020));
        array_push($listBook, new Book(3,8,"c",30,"foneee3", 2020));
        array_push($listBook, new Book(4,9,"d",40,"foneee", 2022));
        array_push($listBook, new Book(5,10,"e",50,"foneee6", 2064));
        return $listBook;
    }
   
    //LẤY DỮ LIỆU TỪ FILE
    static function getListFromFile(){
        $arrData= file("Data/book.txt",FILE_SKIP_EMPTY_LINES);
        $arrData = array_values(array_filter($arrData, "trim"));
        $lsBook = array();
        foreach($arrData as $key => $value){
            $arrItem = explode("#",$value);
            $book =  new Book($arrItem[0], $arrItem[1], $arrItem[2], $arrItem[3], $arrItem[4]);
            array_push($lsBook, $book);
        };
        return  $lsBook;
    }
    static function getListTimKiem($search = null){
        $data = file("Data/book.txt",FILE_SKIP_EMPTY_LINES);
        $arrBook = [];
        foreach($data as $key => $value){
            $row = explode("#",$value);
            if(
                strlen(strstr($row[0],$search)) || strlen(strstr($row[3],$search)) ||
                strlen(strstr($row[1],$search)) || strlen(strstr($row[4],$search)) ||
                strlen(strstr($row[2],$search)) || $search == null
            )
            $arrBook[] = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
            
        }
        return $arrBook;
    }
    static function getListTimKiemDB($keyword){
        $con = Book::connect(); //kết nối
        $sql = "SELECT * FROM book WHERE Title like '%$keyword%' or Author like '%$keyword%'";
        $result = $con->query($sql);
        $lsBookDB = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $book = new Book($row["ID"], $row["Title"], $row["Price"], $row["Author"], $row["Year"]);
                array_push($lsBookDB, $book);
            }
        }
        //giải phóng kết nối
        $con->close();
        return $lsBookDB;
    }
    static function AddToFile($content, $idBook){
        $listBook = Book::getListFromFile();
        $kt = 0;
        foreach ($listBook as $key) {
            if($idBook == $key->id){
                $kt++;
                break;
            }
        }
        if($kt==0){
            $myfile = fopen("Data/book.txt", "a") or die("Unable to open file!");
            // "a" là ghi đè lên
            fwrite($myfile,"\n".$content);
            fclose($myfile);
        }
        else{
            echo "Trùng ID";
        }
        
    }

    static function delBook($idBook){
        $listBook = Book::getListFromFile();
        $myfile = fopen("Data/book.txt", "w") or die("Unable to open file!");  
        unset($listBook[$idBook]);  
        foreach ($listBook as $key => $value) {
            $content = $value->id."#".$value->title."#".$value->price."#".$value->author."#".$value->year;
            fwrite($myfile, $content);
            
        }
        fclose($myfile);
    }
    static function editBook($book){
        $listBook = Book::getListFromFile();
        $myfile = fopen("Data/book.txt", "w") or die("Unable to open file!");
        foreach ($listBook as $key => $value) {
            if($value->id === $book->id){
                $value->title = $book->title;
                $value->price = $book->price;
                $value->author = $book->author;
                $value->year = $book->year;    
            }
            $content = $value->id."#".$value->title."#".$value->price."#".$value->author."#".$value->year;
            fwrite($myfile, $content."\n");
        }
        
        fclose($myfile);
    }
    static function getBookOfPage($page){
        //So item moi trang
        $limit = 5;
        $tempArr = array();
        $listBook = Book::getListFromDB();

        $startItem = ($page-1)*5;
        $endItem = $startItem + 4;

        for ($i = $startItem; $i < $endItem + 1; $i++) {
            # code...
            if(isset($listBook[$i])){
                array_push($tempArr, $listBook[$i]);
            }  
        }

        return $tempArr;
    }
    static function connect(){
        //b1: tạo kết nối
        $con = new mysqli("localhost","root","","BookManager");
        $con->set_charset("utf8");
        if($con->connect_error)
            die("Kết nối thất bại. Chi tiết:" .$con->connect_error);
       //  echo "<h1>Kết nối thành công!</h1>";
       //b2: thao tác vs csdl : crud
        return $con;
    }

    static function getListFromDB(){
         $con = Book::connect();
        $sql = "SELECT * FROM book ";
        $result = $con->query($sql);
        $lsBook = array();
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $book= new Book($row["ID"],$row["Title"],$row["Price"],$row["Author"],$row["Year"]);
                array_push($lsBook, $book);
            }
        }
        //b3: giải phóng kết nối
        $con->close();
        return $lsBook;
    }
    
    static function addBookDB($id,$title,$price,$author,$year){
        $con = Book::connect();
        $sql = "INSERT INTO book (ID ,Title, Price, Author, Year) VALUES ('$id','$title','$price','$author','$year')";
        // $result = $con->query($sql);
        if($con->query($sql)===TRUE){
            echo "Thêm thành công";
        }else{
            echo "Them thất bại". $con->connect_error;
        }
        $con->close();
    }
    static function delBookDB($id){
        $con = Book::connect();
        $sql = "DELETE FROM book  WHERE ID =$id " ;
        // echo $id;
        // $result = $con->query($sql);
        if($con->query($sql) === TRUE){
            echo "Xoa thành công";
        }else{
            echo "Xoa thất bại". $con->connect_error;
        }
            
        $con->close();
    }
    static function editBookDB( $id, $title, $price, $author, $year){
        $con = Book::connect();
        $sql = "UPDATE book SET Title='$title',Price='$price',Author='$author', Year='$year'   WHERE ID=$id";
        // echo "kokok";
        // $result = $con->query($sql);
        if($con->query($sql) === TRUE){
            echo "sua thành công";
        }else{
            echo "sua thất bại". $con->connect_error;
        }
        $con->close();
    }
    static function getBookOfPageFromDB($page)
    {
        $limit = 2;
        $offset = ($page - 1) * $limit;
        $con = Book::connect();
        //Lay du lieu cho trang
        $sql = "SELECT * FROM book LIMIT $offset, $limit";
        $result = $con->query($sql);
        $lsbook = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                # code...
                $book = new Book($row["ID"], $row["Title"], $row["Price"], $row["Author"], $row["Year"]);
                array_push($lsbook, $book);
            }
        }
        $con->close();
        return $lsbook;
    }
    static function getTotalPageFromDB()
    {
        $limit = 2;
        $con = Book::connect();
        //Lay so record cua bang
        $count = "SELECT COUNT(*) FROM book ";
        $result = $con->query($count)->fetch_array();
        $record = $result[0];
        //Tinh so trang
        $totalPage = ceil($record / $limit);
        $con->close();
        return $totalPage;
    }

} 
?>
