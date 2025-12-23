<?php


class Imagen {

    /**
     * Función que sube una imagen a nuestra carpeta img. Además, no solo eso, sino que le renueva el nombre a un timestamp y la extensión a webp.
     * @param array $imagenDatos Son los datos del FILE obtenido desde la superglobal $_FILES
     * @param array $ubicacion Es la ubicación de donde vamos a alojar la imagen.
     * @return string Retorna el nombre y extensión de la imagen.
     */
    public static function subirImagen(array $imagenDatos, string $ubicacion):string  {
        $nombre = explode(".", $imagenDatos['name']);
        array_pop($nombre);
        $nombre = time();
        $extensionNueva = 'webp';
        $nombreFinal = $nombre . "." . $extensionNueva;

        $imagenCargada = move_uploaded_file($imagenDatos['tmp_name'], $ubicacion . "/" . $nombreFinal);

        if(!$imagenCargada) {
            throw new Exception("No se pudo cargar la imagen");
        } else {
            return $nombreFinal;
        }
    }

    /**
     * Función que elimina una imagen vieja de nuestra carpeta img. 
     * @param string $imagen Son los datos de la imagen.
     * @return bool Retorna TRUE si la imagen que se pasó como argumento existe y no hubo problemas para eliminarla. Retorna FALSE si no existía la imagen desde un principio.
     */
    public static function eliminarImagen(string $imagen): bool {
        if (file_exists($imagen)) {

            $fileDelete =  unlink($imagen);

            if (!$fileDelete) {
                throw new Exception("No se pudo eliminar la imagen");
            } else {
                return true;
            }
        }else{
            return false;
        }
    }

}