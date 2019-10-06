
    <?php 
        include_once("header.php")
    ?>
    <?php 
        include_once("nav.php")
    ?>
    
    <?php
        $a = 5 ;
        $b= 6;
        $c = $a+ $b;
        echo "ket qua cua ".$a." + " .$b. " la " .$c;
        echo " </br>";
        echo "ket qua cua $a + $b la $c";
        echo " </br>";
        define('PI', '3.14'); //định nghĩa hằng số
        // $r= 5;
        // $s= pi* $r*$r;
        /**
         * tính diện tích hình tròn
         * @param $r bán kính hình tròn
         * @return diện tích hình tròn có bán kính là
         */
        //hàm
        function dienTichHinhTron($r)
        {
            $s= M_PI* pow($r, 2); //HÀM
            return $s;
        }
        $dtht = dienTichHinhTron(7);
        echo "Diện tích hình tròn là $dtht";
        echo " </br>";
        function sum($n)
        {
            $s =0;
            for($i=0; $i<=$n ; $i++)
            {
                $s += $i;
            }
            return $s;
        }
        $n =5;
        $tong = sum($n);
        echo "Tổng của $n số đầu tiên là $tong";
        echo " </br>";
        function displayToDay()
        {
            $dayOfWeek =[
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thurday",
                "Friday",
                "Saturday"
            ];
            $day = date("w");
            // var_dump($day);
            return $dayOfWeek[$day];
        }
        echo "Hôm nay là ".displayToDay();
    ?>
    <?php 
        include_once("footer.php")
    ?>
    