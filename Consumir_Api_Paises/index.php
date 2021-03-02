<?php
    if (isset($_GET['codigo'])) {
        
        $codigoPais = $_GET['codigo'];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://wft-geo-db.p.rapidapi.com/v1/geo/countries/".$codigoPais,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: wft-geo-db.p.rapidapi.com",
                "x-rapidapi-key: 8243d659a5mshf16d5fa09f8b03cp128f5ajsn5e62a49e9184"
            ],
        ]);

        $response = curl_exec($curl);
        $datos = json_decode($response, true);
        curl_close($curl);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Paises</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body style="background-color: gray">
        <div class="mb-3">
            <form action="" method="GET">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><button type="submit" name="consultar" class="btn btn-success">ENVIAR</button></span>
                    <input type="text" name="codigo" class="form-control" placeholder="Código del país" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
            </form>
        </div>
        <?php
            $msjError = true;
            if((isset($_GET['consultar'])) && isset($datos['data']['code'])) {
                echo "
                    <table class='table table-dark table-hover'>
                        <thead>
                            <th>País</th>
                            <th>Capital</th>
                            <th>Código</th>
                            <th>Moneda</th>
                            <th>Regiones</th>
                        </thead>
                        <tr>
                            <td>".$datos['data']['name']."</td>
                            <td>".$datos['data']['capital']."</td>
                            <td>".$datos['data']['code']."</td>
                            <td>".$datos['data']['currencyCodes'][0]."</td>
                            <td>".$datos['data']['numRegions']."</td>
                        </tr>
                    </table><br/>
                    <center>
                        <img alt='Imagen' src='".$datos['data']['flagImageUri']."'/>
                    </center>";
                $msjError = false;
            }
            if ((isset($_GET['consultar'])) && ($msjError == true)) {
                echo "<div class='alert alert-danger' role='alert'>Código inválido!</div>"; 
            }
        ?>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>
                