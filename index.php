<?php

$agenda="";
if ($_POST['enviar']) {


    $nombre = $_POST['nombre']; //el evento
    $telefono = $_POST['telefono']; //el evento
    $agenda = $_POST['agenda']; //el historico
   
    //$agenda[$nombre] = $telefono;
    
    switch ($_POST['enviar']){
        
        case 'Añadir contacto':
        if($nombre==null){//Si el nombre esta vacio que muestre un mensaje
        
        $msj="Debes introducir el nombre y el telefono";
        
        }else{//si el nombre existe
            
        if ($telefono==null){//Si telefono es null
                unset($agenda[$nombre]);//me borre el nombre y el telefono, del nombre introducido
        }else if (!is_numeric($telefono)){//si el telefono no es numerico introduzco un mensaje recordsndolo
    
         $msj="Debes introducir el telefono con numeros";
        }else{//Si todo esta correcto introducimos los datos en el array
            $agenda[$nombre]=$telefono;
        }

    
        }
            break;
            
        case 'Eliminar contactoS'://eliminar todos los elementos del array agenda    
            
            unset($agenda);
            break;
    
        
    }
}
   

function añadir($agenda){//añadimos los datos en el array
    foreach ($agenda as $nombre => $telefono) {
    //historico en input hidden
     echo "<input type=hidden name='agenda[$nombre]' value=$telefono>";
    
    }
}
function visualizar ($agenda){//mostramos los datos del array en una tabla
    foreach ($agenda as $nombre => $telefono) {
    //visualizo
      
    echo"<tr><td>$nombre</td><td>$telefono</td></tr>";
}
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <script src='https://unpkg.com/vue'></script>
    <title> Agenda de contactos</title>
</head>
<header>
    <?php
                if($agenda==null){//Si el array agenda esta vacio, no contiene ningun contacto
                    echo "Agenda de contactos sin contactos actualmente "; }
                else{//Sino si que contiene contactos
                    echo "Agenda de contactos ";}?>
</header>
<body>


<!-- Creamos el formulario para insertr los nuevos datos-->
<fieldset>
    <legend>Nuevo Contacto</legend>
    <?php echo $msj;//mostramos mensaje ?>
    <form action=index.php method="POST">
        <br>
        <label for="nombre">Nombre</label><input type="text" name="nombre" size="15"/><br/>
        <label for="telefono">Teléfono </label><input type="text" name="telefono" size="15"/><br/>
        <input type="submit" value="Añadir contacto" name="enviar">
        <input type="submit" value="Eliminar contactos " name="enviar" >

        <!-- Metemos los contactos existentes  ocultos en el formulario-->
         
    <div class="center">LISTADO DE CONTACTOS</div>
    <hr>
    <div class="center">
   
 
    <?php
                if($agenda==null){//Si la agenda no contiene contactos
                    echo "Agenda sin contactos"; }
                else{//Si la agenda contiene contactos, y me los muestra en la tabla?>
        
        <table><tr><td>Nombre</td><td>Teléfono</td></tr><?php añadir($agenda);visualizar($agenda); ?> </table>
                   
                    
                    
              <?php  }?>
    
        </div>
          
         
      </form>   
</fieldset>


</body>

</html>
