<?php 
class Book{
    #-->properties
    var $id;
    var $price ;
    var $title;
    var $author;
    var $year;
    #end properties
    #construct
    function __construct($id, $title,$price ,$author, $year)
    {
        $this->id= $id;
        $this->title = $title;
        $this->price =$price;
        $this->author = $author;
        $this->year = $year;
    }
    function display(){
        echo "ID : ".$this->id ."<br>";
        echo "Title : ".$this->title ."<br>";
        echo "Price : ".$this->price ."<br>";
        echo "Author : ".$this->author ."<br>";
        echo "Year : ".$this->year ."<br>";
    }
    #mod data 
    /**
     * lấy toàn bộ dữ liệu có trong csdl
     */
    static function getList(){
        $listBook = array();
        array_push($listBook, new Book(1,"a",10,"foneee", 2020));
        array_push($listBook, new Book(2,"b",20,"foneee2", 2020));
        array_push($listBook, new Book(3,"c",30,"foneee3", 2020));
        array_push($listBook, new Book(4,"d",40,"foneee", 2022));
        array_push($listBook, new Book(5,"e",50,"foneee6", 2064));
        return $listBook;
    }
   
    //LẤY DỮ LIỆU TỪ FILE
    static function getListFromFile(){
        $arrData= file("Data/book.txt",FILE_SKIP_EMPTY_LINES);
        // var_dump($arrData);
        $lsBook = array();
        // echo "<ul>";
        foreach($arrData as $key=>$value){
            // echo "<li>".$value . "</li>";
            $arrItems = explode("#",$value);
            $book= new Book($arrItems[0],$arrItems[1],$arrItems[2],$arrItems[3],$arrItems[4]);
            array_push($lsBook, $book);
        }
        // echo "</ul>";
        return  $lsBook;
    }
    static function getListTimKiem($search = null){
        $data = file("Data/book.txt");
        $arrBook = [];
        foreach($data as $key => $value){
            $row = explode("#",$value);
            if(
                strlen(strstr($row[0],$search)) || strlen(strstr($row[3],$search)) ||
                strlen(strstr($row[1],$search)) || strlen(strstr($row[4],$search)) ||
                strlen(strstr($row[2],$search)) || $search == null
            )
            $arrBook[] = new Book($row[0],$row[2],$row[1],$row[3],$row[4]);
        }
        return $arrBook;
    }
    static function AddToFile($content){
        $myfile = fopen("Data/book.txt", "a") or die("Unable to open file!");
        fwrite($myfile, "\n". $content);
        fclose($myfile);
    }
    static function deleteBoook($id, $title, $price, $author, $year ){
        $data = Book::getListTimKiem();
        $arrBook = [];
        $content = "";
        foreach($data as $key => $value){
            if($value->id != $id && $value->price != $price && $value->title != $title &&$value->author != $author &&$value->year != $year)
                $arrBook[] = $value;
        }
        
        $myfile = fopen("Data/book.txt", "a") or die("Unable to open file!");
        foreach($arrBook as $key => $value){
            $content .= $value->id."#".$value->title."#".$value->price."#".$value->author."#".$value->year;
        }
        fwrite($myfile, $content);
        fclose($myfile);
    }
}
?>
