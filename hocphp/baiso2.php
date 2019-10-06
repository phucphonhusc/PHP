<?php 
    include_once("header.php")
?>
<?php 
    include_once("nav.php")
?>
    <form action="">
        <input type="text" name="num1" value="<?php   echo $_GET["num1"]?? "" ?>" placeholder="Số thứ nhất">
        <input type="text" name="num2" value="<?php  echo $_GET["num2"]?? "" ?>" placeholder="Số thứ hai">
        <select name="operator" id="">
            <option value="none">Vui lòng chọn phép tính</option>
            <option <?php if( isset($_GET ["operator"])) echo $_GET["operator"] == "add" ? "selected" :""?> value="add">Cộng</option>
            <option <?php if( isset($_GET ["operator"])) echo $_GET["operator"] == "sub" ? "selected" :""?> value="sub">Trừ</option>
            <option <?php if( isset($_GET ["operator"])) echo $_GET["operator"] == "multi" ? "selected" :""?> value="multi">Nhân</option></option>
            <option <?php if( isset($_GET ["operator"])) echo $_GET["operator"] == "div" ? "selected" :""?> value="div">Chia</option>
        </select>
        <button name="btnCalculator" type="submit" value="1">Tính</button>
        <?php 
        // var_dump ($_GET);
        if( isset($_GET ["btnCalculator"]))
        {
            $num1= $_GET["num1"];
            $num2= $_GET["num2"];
            $operator = $_GET["operator"];
            $sign ="";
            // $result = $num1 + $num2;
           switch ($operator) {
               case 'add':
                    $result = $num1 + $num2;
                    $sign ="+";
                   break;
                case 'sub':
                    $result = $num1 - $num2;
                    $sign ="-";
                   break;
                case 'multi':
                    $result = $num1 * $num2;
                    $sign ="*";
                   break;
                case 'div':
                    $result = $num1 / $num2;
                    $sign ="/";
                   break;
               
               default:
                   $result = "Vui lòng chọn phép tính trước!";
                   break;
    
           }
            echo "<h3>Kết quả $num1 $sign $num2 = $result</h3>";
        }
        ?>
    </form>
    <?php 
        include_once("footer.php")
    ?>
    
