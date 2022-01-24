<!DOCTYPE html>
<head><title>Calculation result</title></head>
<body>



<?php

$first_number= $_GET["firstnumber"];
$second_number=$_GET["secondnumber"];


if(!isset($_GET["operation"])){
    echo"Please select an arithmetic operation!";
    header("refresh:2; url= http://ec2-34-224-166-178.compute-1.amazonaws.com/~finleylee2507/Calculator.html");

}


else{
    $operator = $_GET["operation"];
    if($operator=="plus"){

        $result=$first_number+$second_number;
        echo "The result is $result";
    
    
    }
    
    elseif($operator=="minus"){
         $result=$first_number-$second_number;
         echo "The result is $result";
    }
    
    elseif($operator=="multiply"){
        $result=$first_number*$second_number;
        echo "The result is $result";
    }
    elseif($operator=="divide"){
        if($second_number!=0){
            $result=$first_number/$second_number;
            echo "The result is $result";
        }
        else{
            echo "Cannot divide a number by 0. Please check your input";
            
        }
    }


}






















?>









</body>
</html>