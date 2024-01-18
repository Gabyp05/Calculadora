<?php

$numeroActual = 0;
$Operacion = [];

function getOperacion($valores){
    $n = "";
    foreach ($valores as $valor){
        $n .= $valor;
    }
    return $n;
}

function calcularOperacion($nIngresado){
    $arr = [];
    $char = "";
    foreach ($nIngresado as $num){
        if(is_numeric($num) || $num == "."){
            $char .= $num;
        }else if(!is_numeric($num)){
            if(!empty($char)){
                $arr[] = $char;
                $char = "";
            }
            $arr[] = $num;
        }
    }
    if(!empty($char)){
        $arr[] = $char;
    }


$numero = 0;
$operador = null;
for($i=0; $i<= count($arr)-1; $i++){
    if(is_numeric($arr[$i])){
        if($operador){
            if($operador == "+"){
                $numero = $numero + $arr[$i];}
            
            if($operador == "-"){
                $numero = $numero - $arr[$i];}
            
            if($operador == "x"){
                $numero = $numero * $arr[$i];}
            
            if($operador == "/"){
                $numero = $numero / $arr[$i];}
        
            $operador = null;
            }
            else{
                if($numero == 0){
                    $numero = $arr[$i];}
            }
                
        }else{
            $operador = $arr[$i];
        }
    }
    return $numero;
}


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['Operacion'])){
        $Operacion = json_decode($_POST['Operacion']);
    }

    if(isset($_POST)){
        foreach ($_POST as $key=>$valor){
            if($key == "calcular"){
               $numeroActual = calcularOperacion($Operacion);
               $Operacion = [];
               $Operacion[] = $numeroActual;
            }elseif($key == "c"){
                $Operacion = [];
                $numeroActual = 0;
            }elseif($key == "borrar"){
                $lastPointer = count($Operacion) -1;
                if(is_numeric($Operacion[$lastPointer])){
                    array_pop($Operacion);
                }
            }elseif($key != "Operacion"){
                $Operacion[] = $valor;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calculadora Gabriela Patiño 283A3</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
</head>
<style>
    *{
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }
    body{
        width: 100vw; 
        background: linear-gradient(225deg, hsla(23, 92%, 71%, 1) 0%, hsla(345, 43%, 54%, 1) 100%);
    }

    h2,h3{
        font-size: 20px;
        font-weight: 400;
        padding: 10px;
        padding-bottom: 0;
    }

    p, a{
        font-size: 16px;
        font-weight: 300;
        padding-left: 10px;
    }

    .calculadora{
            position: absolute;
            width: 230px;
            background: rgba( 255, 255, 255, 0.4 );
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
            backdrop-filter: blur( 6px );
            margin-left: 40px;
            margin-top: 25px;
            border-radius: 15px;
            padding: 15px;
    }

    .botones{
            width: 50px;
            height: 50px;
            font-size: 25px;
            cursor: pointer;
            margin: 3px;
            background-color: #fff;
            border: none;
            color: #cc5803;
            border-radius: 10px;
        }

    .botones:hover{
        background-color: #cc5803;
        color: #fff;
    }
    .pantalla{
        width: 207px;
        height: 30px;
        margin: 9px 7px;
        font-size: 25px;
        color: #cc5803;
        text-align: right;
        padding: 6px;
        border: none;
        border-radius: 10px;
    }
    
    
</style>
<body>
<h2>Calculadora</h2>
<p> Gabriela Patiño Sección 283A3  </p>
<div class="calculadora"> 
    <div>
    <form method="post">
    <input type="hidden" name="Operacion" value='<?php echo json_encode($Operacion);?>'/>
    <input type="text" class="pantalla" value='<?php echo getOperacion($Operacion);?>'/>
    <table> 
        <tr>
            <td colspan="2"><input type="submit" class="botones"  style="width: 106px;" name="c" value="AC"/></td>
            <td><button type="submit" class="botones" name="borrar" value="borrar">&#8592;</button></td>
            <td><input type="submit" class="botones" name="multiplicacion" value="x"/></td> 
        </tr>
        <tr>
            <td><input type="submit" class="botones" name="1" value="1"/></td>
            <td><input type="submit" class="botones" name="2" value="2"/></td>
            <td><input type="submit" class="botones" name="3" value="3"/></td>
            <td><input type="submit" class="botones" name="suma" value="+"/></td>
        </tr>
        <tr>
            <td><input type="submit" class="botones" name="4" value="4"/></td>
            <td><input type="submit" class="botones" name="5" value="5"/></td>
            <td><input type="submit" class="botones" name="6" value="6"/></td>
            <td><input type="submit" class="botones" name="resta" value="-"/></td>
        </tr>
        <tr>
            <td><input type="submit" class="botones" name="7" value="7"/></td>
            <td><input type="submit" class="botones" name="8" value="8"/></td>
            <td><input type="submit" class="botones" name="9" value="9"/></td> 
            <td><button type="submit" class="botones" name="division" value="/">&#247;</button></td>
        </tr>
        <tr>
            <td><input type="submit" class="botones" name="." value="."/></td>
            <td><input type="submit" class="botones" name="0" value="0"/></td>
            <td colspan="2"><input type="submit" class="botones" style="width: 106px;" name="calcular" value="="/></td> 
            
        </tr>
    </table>
    </form>
    </div>
</div>

</body>
</html>
