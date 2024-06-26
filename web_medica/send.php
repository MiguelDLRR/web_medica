<?php
    
    /*
    Este código PHP se encarga de recibir datos de un formulario, validar que todos los campos estén completos, limpiar los datos de posibles espacios en blanco innecesarios, 
    e intentar insertar los datos en una base de datos MySQL. 
    Si la inserción es exitosa, se notifica al usuario, y si hay un error, también se notifica al usuario con un mensaje de error detallado.
    
    */
    include("conexion.php");

    if(isset($_POST['send'])) { //Esta línea verifica si el formulario ha sido enviado comprobando si la variable $_POST['send'] está definida. $_POST['send'] corresponde al nombre del botón de envío en el formulario HTML.
        if(
            //Aquí se verifica que los campos del formulario name, phone, email y message no estén vacíos. Se utiliza strlen para asegurarse de que cada campo tiene al menos un carácter.
            strlen($_POST['name']) >= 1 &&
            strlen($_POST['phone']) >= 1 &&
            strlen($_POST['email']) >= 1 &&
            strlen($_POST['message']) >= 1
        ) {
            //Las funciones trim() eliminan los espacios en blanco al inicio y al final de las entradas del formulario, y luego se asignan los valores a las variables $name, $phone, $email y $message.
            $name =trim($_POST['name']); 
            $phone =trim($_POST['phone']);
            $email=trim($_POST['email']);
            $message =trim($_POST['message']);
            //Se crea una cadena SQL que inserta los valores proporcionados en la tabla datos en las columnas nombre, telefono, email y mensaje.
            $consulta ="INSERT INTO datos(nombre,telefono,email,mensaje)
            VALUES ('$name', '$phone','$email', '$message')";
            //Se ejecuta la consulta SQL utilizando la función mysqli_query() que toma dos parámetros: la conexión a la base de datos $conex y la consulta SQL $consulta.
            $resultado =mysqli_query($conex, $consulta);

            
            //Si la consulta SQL se ejecuta correctamente, se imprime el mensaje "Datos insertados correctamente". 
            //Si hay un error, se imprime "Error en la inserción de datos" junto con el mensaje de error específico utilizando mysqli_error($conex).
            if ($resultado){
                echo "Datos insertados correctamente";
            } else {

                echo "Error en la inserción de datos: ". mysqli_connect($conex);
            } 
        }else {
            //Si uno o más de los campos del formulario están vacíos, se imprime el mensaje "Por favor, complete todos los campos."
            echo "Por favor, complete todos los campos.";
        }
    }

?>