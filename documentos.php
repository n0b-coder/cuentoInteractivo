

<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>


<?php
require_once("conexion.php");

$username = $_POST["username"];


$result = $conn->mysql("SELECT username, password FROM users WHERE username = '$username'");

foreach ($result as $key => $value) {
	# code...
}

$data = array();


$result = $conn->mysql("SELECT * FROM pilares");

foreach ($result as $key => $value) {
	array_push($data, $value);
}

$datos = json_encode( data );

echo $datos;

?>


<script type="text/javascript">

const request = new Request('https://www.mozilla.org/datosCuento.php');

fetch(request)
  .then(response => {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error('Something went wrong on api server!');
    }
  })
  .then(response => {
  	/*
  	response = {
			dato1: valor1,
			dato2: valor2,
			dato3: valor3,
  		}
  		*/
    console.debug(response);
    // ...
  }).catch(error => {
    console.error(error);
  });

</script>




