<?php
    $token = '5866736897:AAGTNngvtsYI4awYwXW019-w_QlrQoGFXSE';
    $web = 'https://api.telegram.org/bot' . $token;

    $input = file_get_contents('php://input');
    $update = json_decode($input , TRUE);

    $chatid = $update['message']['chat']['id'];
    $mensaje = $update['message']['text'];

    switch($mensaje){
        case '/start':
            $respuesta = 'Hola, Me has iniciado';
            sendMessage($chatid, $respuesta);
            break;
        case '/info':
            $respuesta = 'soy @Terriselbot encantado de conocerte';
            sendMessage($chatid, $respuesta);
            break;
        case '/bulbasur':
                // Hacemos la petición a la API de PokéAPI para obtener los datos de Bulbasur
                $url = 'https://pokeapi.co/api/v2/pokemon/bulbasur';
                $data = file_get_contents($url);
                $pokemon = json_decode($data);
    
                // Obtenemos la URL de la imagen de Bulbasur
                $image_url = $pokemon->sprites->front_default;
    
                // Enviamos la imagen como un mensaje en el bot de Telegram
                sendPhoto($chatid, $image_url);
                break;    
        case '/charmander':
            // Hacemos la petición a la API de PokéAPI para obtener los datos de Charmander
            $url = 'https://pokeapi.co/api/v2/pokemon/charmander';
            $data = file_get_contents($url);
            $pokemon = json_decode($data);

            // Obtenemos la URL de la imagen de Charmander
            $image_url = $pokemon->sprites->front_default;

            // Enviamos la imagen como un mensaje en el bot de Telegram
            sendPhoto($chatid, $image_url);
            break;
        case '/squirtle':
                // Hacemos la petición a la API de PokéAPI para obtener los datos de Squirtle
                $url = 'https://pokeapi.co/api/v2/pokemon/squirtle';
                $data = file_get_contents($url);
                $pokemon = json_decode($data);
    
                // Obtenemos la URL de la imagen de Squirtle
                $image_url = $pokemon->sprites->front_default;
    
                // Enviamos la imagen como un mensaje en el bot de Telegram
                sendPhoto($chatid, $image_url);
                break; 
            case '/pikachu':
                    // Hacemos la petición a la API de PokéAPI para obtener los datos de Pikachu
                    $url = 'https://pokeapi.co/api/v2/pokemon/pikachu';
                    $data = file_get_contents($url);
                    $pokemon = json_decode($data);
        
                    // Obtenemos la URL de la imagen de Pikachu
                    $image_url = $pokemon->sprites->front_default;
        
                    // Enviamos la imagen como un mensaje en el bot de Telegram
                    sendPhoto($chatid, $image_url);
                    break; 
        default :
            $respuesta = 'No te entiendo';
            sendMessage($chatid, $respuesta);
            break;
    }

    function sendMessage($chatid, $respuesta){
        $url = $GLOBALS['web'].'/sendMessage?chat_id='.$chatid.'&parse_mode=HTML&text='.urlencode($respuesta);
        file_get_contents($url);
    }
    function sendPhoto($chatid, $image_url){
        $url = $GLOBALS['web'].'/sendPhoto';
        $post_fields = array(
            'chat_id' => $chatid,
            'photo' => $image_url,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
?>