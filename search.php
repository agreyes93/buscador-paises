<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paises</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <nav class="navbar navbar-light bg-light navbar-static-top">
        <a class="navbar-brand">Paises del Mundo</a>
        <form class="form-inline">
            <select class="form-control" id="region">
                <option value="all">Filtrar por Region</option>
                <option value="Africa">Africa</option>
                <option value="Americas">America</option>
                <option value="Asia">Asia</option>
                <option value="Europe">Europa</option>
                <option value="Oceania">Oceania</option>
            </select>
        </form>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar Pais" aria-label="Buscar Pais" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <div class="prueba">

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#buscar').keyup(function(){ // -->ESTO ES JAVASCRIPT USANDO JQUERY

                //CUANDO EL USUARIO EMPIECE A ESCRIBIR ALGO EN EL CAMPO BUSCAR SE DISPARA: 
                // $(this).val(); QUIERE DECIR EL VALOR DE LA CAJA DE TEXTO BUSCAR

                // LO VOY A GUARDAR EN UNA VARIABLE
                var palabraClave = $(this).val();

                //VIENDO SI LA PALABRA CLAVE O SEA EL VALRO EN LA CAJA DE TEXTO BUSCAR ESTA VACIA
                if(palabraClave == ""){
                    console.log('Debe insertar un valor para buscar');
                }
                
                //CON ESTE PEDAZO DE CODIGO YO HAGO LA PETICION A LA API DE PAISES PARA TRAER LOS PAISES 
                //QUE COMIENCE CON EL NOMBRE QUE VENGA EN LA CAJA DE TEXTO BUSCAR

                var buscarPais = $.ajax({ // --> ESTO AJAX
                    type: 'GET',
                    url: 'https://restcountries.eu/rest/v2/name/'+ palabraClave,
                    dataType: 'JSON'

                });

                buscarPais.done(function(data){

                    var listaPaises = $('.prueba');
                    listaPaises.empty();
                    data.forEach(function(item){

                        var flag = $('<img>').attr('src',item.flag);
                        $('<table>').appendTo(listaPaises);

                        $('<li>').addClass('flag').append(flag).appendTo(listaPaises);
                        $('<li>').html('<b>' + item.name+'</b>').addClass('name').appendTo(listaPaises);
                        $('<li>').html('<b>Capital: </b>' + item.capital).appendTo(listaPaises);
                        $('<li>').html('<b>Region: </b>' + item.region).appendTo(listaPaises);
                        $('<li>').html('<b>Sub region: </b>' + item.subregion).appendTo(listaPaises);
                        $('<li>').html('<b>Población: </b>' + item.population).appendTo(listaPaises);
                        $('</table>').appendTo(listaPaises);


                    });

                        //$('.prueba').html(`<img src="${data[0].flag}"></img>`);
                    
                  
                });

                buscarPais.fail(function(xhr, status, error){
                    //ESTOY VALIDANDO QUE SI LO QUE ESCRIBI NO ARROJA RESULTADOS DE LA BUSQUEDA
                    if(xhr.status == 404){
                        // COMO NO ARROJO RESULTADOS, ESCRIBO UN MENSAJE PARA EL USUARIO
                        console.log('No hay coincidencias segun la busqueda');
                    }
                    if(xhr.status == 500){
                        //POR SI HAY UN FALLO EN LA API
                        console.log('Ocurrio un error inesperado');
                    }
                })
            });
        });
    </script>

    <style type="text/css">
        
        td {
            border: 1px solid black;
        }

    </style>
</body>
</html>