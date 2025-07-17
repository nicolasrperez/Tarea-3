<?php
//include_once("libreria/motor.php");
include_once("libreria/carteles.php");

$str_b =  $_GET['b'];
//echo "QUE".$_GET['b'];
$cart = Cartel::seleccionar($str_b);

if (isset($cart)){
    echo '<link rel="stylesheet" href="bootstrap/carteles.css">';
    
    foreach($cart as $carteles){
        switch($carteles['plantilla']){
            case 4:
            case 5:
                echo '<div class="plantilla'.$carteles['plantilla'].'">';
                echo "<header><h1>{$carteles['titulo']}</h1></header>";
                echo "<article>{$carteles['texto']}</article>";
                if($carteles['link'] != ""){   
                    echo "<nav><a href='{$carteles['link']}' target='_blank'>{$carteles['titulo']} en la web</a></nav>";
                }
                if($carteles['v_desde'] != "" || $carteles['v_hasta'] != ""){
                    echo "<footer><h3>{$carteles['v_desde']} {$carteles['v_hasta']}</h3></footer>";
                }
                echo '</div><br>';
                break;
            default:
                echo '<div class="plantilla'.$carteles['plantilla'].'">';
                
                // Procesar imagen1, video o audio para la cabecera
                if($carteles['imagen1'] != ""){
                    $archivo = "images/cartelera/".$carteles['imagen1'];
                    $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                        echo "<video width='320' height='240' controls>
                                <source src='$archivo' type='video/$ext'>
                                Tu navegador no soporta la reproducción de video.
                              </video>";
                        echo "<header><h1>{$carteles['titulo']}</h1></header>";
                    } elseif (in_array($ext, ['mp3', 'wav', 'ogg'])) {
                        echo "<audio controls>
                                <source src='$archivo' type='audio/$ext'>
                                Tu navegador no soporta la reproducción de audio.
                              </audio>";
                        echo "<header><h1>{$carteles['titulo']}</h1></header>";
                    } else {
                        echo "<div style=\"background-image: url($archivo);\"><header>
                            <h1>{$carteles['titulo']}</h1>
                            </header></div>";
                    }
                } else {
                    echo "<header><h1>{$carteles['titulo']}</h1></header>";
                }

                if($carteles['link'] != ""){   
                    echo "<nav><a href='{$carteles['link']}' target='_blank'>{$carteles['titulo']} en la web</a></nav>";
                }
                echo "<article>{$carteles['texto']}</article>";

                // Procesar imagen, video o audio para el contenido
                if($carteles['imagen'] != "" && $carteles['texto1'] != "" && $carteles['texto2'] != ""){
                    $archivo = 'images/cartelera/'.$carteles['imagen'];
                    $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    
                    echo "<div id='cartel_imagen' class='row'>";
                    echo "<div class='col-sm-4'>{$carteles['texto1']}</div>";
                    echo "<div class='col-sm-4'>";
                    
                    if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                        echo "<video width='100%' controls>
                                <source src='$archivo' type='video/$ext'>
                                Tu navegador no soporta la reproducción de video.
                              </video>";
                    } elseif (in_array($ext, ['mp3', 'wav', 'ogg'])) {
                        echo "<audio controls style='width:100%'>
                                <source src='$archivo' type='audio/$ext'>
                                Tu navegador no soporta la reproducción de audio.
                              </audio>";
                    } else {
                        echo "<img src='$archivo' style='max-width:100%; height:auto;'>";
                    }
                    
                    echo "</div>";
                    echo "<div class='col-sm-4'>{$carteles['texto2']}</div>";
                    echo "</div>";
                } elseif($carteles['imagen'] != "" && $carteles['texto1'] == "" && $carteles['texto2'] == ""){
                    $archivo = 'images/cartelera/'.$carteles['imagen'];
                    $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    echo "<div id='cartel_imagen' class='row'>";
                    echo "<div class='col-sm-2'></div>";
                    echo "<div class='col-sm-10'>";
                    
                    if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                        echo "<video width='100%' controls>
                                <source src='$archivo' type='video/$ext'>
                                Tu navegador no soporta la reproducción de video.
                              </video>";
                    } elseif (in_array($ext, ['mp3', 'wav', 'ogg'])) {
                        echo "<audio controls style='width:100%'>
                                <source src='$archivo' type='audio/$ext'>
                                Tu navegador no soporta la reproducción de audio.
                              </audio>";
                    } else {
                        echo "<img src='$archivo' style='max-width:100%; height:auto;'>";
                    }
                    
                    echo "</div>";
                    echo "</div>";
                } elseif($carteles['imagen'] != "" && $carteles['texto1'] != "" && $carteles['texto2'] == ""){
                    $archivo = 'images/cartelera/'.$carteles['imagen'];
                    $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    echo "<div id='cartel_imagen' class='row'>";
                    echo "<div class='col-sm-6'>{$carteles['texto1']}</div>";
                    echo "<div class='col-sm-6'>";
                    
                    if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                        echo "<video width='100%' controls>
                                <source src='$archivo' type='video/$ext'>
                                Tu navegador no soporta la reproducción de video.
                              </video>";
                    } elseif (in_array($ext, ['mp3', 'wav', 'ogg'])) {
                        echo "<audio controls style='width:100%'>
                                <source src='$archivo' type='audio/$ext'>
                                Tu navegador no soporta la reproducción de audio.
                              </audio>";
                    } else {
                        echo "<img src='$archivo' style='max-width:100%; height:auto;'>";
                    }
                    
                    echo "</div>";
                    echo "</div>";
                } elseif($carteles['imagen'] != "" && $carteles['texto1'] == "" && $carteles['texto2'] != ""){
                    $archivo = 'images/cartelera/'.$carteles['imagen'];
                    $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    echo "<div id='cartel_imagen' class='row'>";
                    echo "<div class='col-sm-6'>";
                    
                    if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                        echo "<video width='100%' controls>
                                <source src='$archivo' type='video/$ext'>
                                Tu navegador no soporta la reproducción de video.
                              </video>";
                    } elseif (in_array($ext, ['mp3', 'wav', 'ogg'])) {
                        echo "<audio controls style='width:100%'>
                                <source src='$archivo' type='audio/$ext'>
                                Tu navegador no soporta la reproducción de audio.
                              </audio>";
                    } else {
                        echo "<img src='$archivo' style='max-width:100%; height:auto;'>";
                    }
                    
                    echo "</div>";
                    echo "<div class='col-sm-6'>{$carteles['texto2']}</div>";
                    echo "</div>";
                }

                if($carteles['v_desde'] != "" || $carteles['v_hasta'] != ""){
                    echo "<footer><h3>{$carteles['v_desde']} {$carteles['v_hasta']}</h3></footer>";
                }
                echo '</div><br>';
                break;
        }
    }
}
?>
