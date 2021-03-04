<?php
function hacerPeticionHTTP ($url, $metodo, $arreglo) {
    
    $curl = curl_init();
    $header = array('Content-Type: application/json');
    
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $metodo,
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_POSTFIELDS => json_encode($arreglo)
    ]);
    
    $respuesta = curl_exec($curl);
    
    curl_close($curl);
    
    return $respuesta;
}

if (isset($_POST['getUsuarios'])) {
    $url = "http://localhost:8080/usuario";
    $metodo = "GET";
    $respuesta = hacerPeticionHTTP($url, $metodo, null);
    $datos = json_decode($respuesta, true);
}
if (isset($_POST['getUsuarioPorId'])) {
    $id = $_POST['idUsuario'];
    $url = "http://localhost:8080/usuario/".$id;
    $metodo = "GET";
    $respuesta = hacerPeticionHTTP($url, $metodo, null);
    $datos = json_decode($respuesta, true);
}
if (isset($_POST['getUsuarioPorNombre'])) {
    $nombre = $_POST['nameUsuario'];
    $url = "http://localhost:8080/usuario/consulta?nombre=".$nombre;
    $metodo = "GET";
    $respuesta = hacerPeticionHTTP($url, $metodo, null);
    $datos = json_decode($respuesta, true);
}
if (isset($_POST['saveUsuario'])) {
    $url = "http://localhost:8080/usuario";
    $metodo = "POST";
    $postData = array("nombre" => $_POST['nombreUsuario'], "apellido" => $_POST['apellidoUsuario'], "email" => $_POST['emailUsuario']);
    $respuesta = hacerPeticionHTTP($url, $metodo, $postData);
    $datos = json_decode($respuesta, true);
}
if (isset($_POST['updateUsuario'])) {
    $url = "http://localhost:8080/usuario";
    $metodo = "PUT";
    $postData = array("id" => $_POST['numeroUsuario'], "nombre" => $_POST['nombreUsuario'], "apellido" => $_POST['apellidoUsuario'], "email" => $_POST['emailUsuario']);
    $respuesta = hacerPeticionHTTP($url, $metodo, $postData);
    $datos = json_decode($respuesta, true);
}
if (isset($_POST['deleteUsuarioPorId'])) {
    $id = $_POST['idOculto'];
    $url = "http://localhost:8080/usuario/".$id;
    $metodo = "DELETE";
    $respuesta = hacerPeticionHTTP($url, $metodo, null);
}


