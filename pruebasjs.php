<?php

var datos = {

  "secciones": [
    { "id_seccion": 1,
      "paginas": [
        {"id_pagina": 5, "texto":"1arstars"},
        {"id_pagina": 6, "texto":"2arstars"},
        {"id_pagina": 7, "texto":"3arstars"}
      ]
    },
    { "id_seccion": 2,
      "paginas": [
        {"id_pagina": 8, "texto":"4arstars"},
        {"id_pagina": 9, "texto":"5arstars"},
        {"id_pagina": 10, "texto":"6arstars"}
      ]
    }
  ],

  "pilares": [
    {
      "id": 2,
      "nombre":"dos",
      "imagen": "media/img_pilar2.jpg",
      "texto": "arstarstars",
      "acertijo": [
        {"escena": 0, "ruta": "media/img_pilar2_pasado.jpg" },
        {"escena": 1, "ruta": "media/img_pilar2_presente.jpg" },
        {"escena": 2, "ruta": "media/img_pilar2_futuro.jpg" }
      ]
    },
    {"id": 3, "nombre":"tres"},
    {"id": 5, "nombre":"cinco", "imagen": "media/imagen1.jpg"}
  ]
}




foreach ($result as $key => $value) {
    # code...
}

$id_pilar = $GET["id_pilar"]

$imagen = $POST["imagen_subida"] // /tmp/php/imagen1.jpg

//copie a media/imagen1.jpg
$imagen_ruta = "media/imagen1.jpg"

$pilares = array();


$result = $conn->mysql("SELECT * FROM pilar WHERE pilar.id=$id_pilar");
$result = $conn->mysql("SELECT * FROM pilar");

for (var row = mysqli->fetch_assoc()) {

    array_push($pilares, $row);
    $id_acertijo = $row["id_acertijo"];
    $img_indagacion = $conn->mysql("SELECT * FROM img_acertijos WHERE id_acertijo=$id_acertijo");
    $imagenes_acertijo = array();
    for( $im in img_indagacion->fetch_array())
    {
      array_push($imagenes_acertijo, $im);
    }

    $pilares["acertijos"] = $imagenes_acertijo;
}



foreach ($result as $key => $value) {
    array_push($data, $value);
}


$datosFinales = array();

$datosFinales["pilares"] = $pilares;

$datos = json_encode( data );

echo $datos;


?>