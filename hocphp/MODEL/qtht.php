<?php 
class QTHT{
    var $tunam;
    var $dennam;
    var $lop;
    var $noihoc;
    function __construct($tunam, $dennam, $lop, $noihoc)
    {
        $this->tunam = $tunam;
        $this->dennam= $dennam;
        $this->lop= $lop;
        $this->noihoc= $noihoc;
    }
    static function getListQTHT(){
        $listQTHT = array();
        array_push($listQTHT, new QTHT(2004,2009,"Tiểu học","Dạ Lê"));
        array_push($listQTHT, new QTHT(2009,2013,"THCS","Thủy Phương"));
        array_push($listQTHT, new QTHT(2013,2016,"THPT","Hương Thủy"));
        array_push($listQTHT, new QTHT(2016,2020,"Đại học","ĐHKH Huế"));
        return $listQTHT;
    }
}
?>
