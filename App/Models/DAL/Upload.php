<?php

namespace App\Models\DAL;

class Upload {
    public function upload($pasta){
        $uploaddir = __DIR__ . DIRECTORY_SEPARATOR .'temp' . DIRECTORY_SEPARATOR;
        $uploadfile = $uploaddir . basename($_FILES['arquivo']['name']);

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
            //Aqui trocamos as barras invertidas do diretório atual para barras normais
            $upload = str_replace('\\','/', $uploaddir);
            //Aqui retiramoss do diretório atual as pastas app/models/dal/temp e mudamos para a nova pasta que irá receber os arquivos
            $dirNovo = str_replace('App/Models/DAL/temp/','', $upload) . 'Public/temp/';
            //Aqui obtemos o caminho completo atual do arquivo
            $upload = $upload . $_FILES['arquivo']['name'];
            //Aqui obtemos a extensão do arquivo
            $ext = pathinfo($upload, PATHINFO_EXTENSION);
            //Aqui criamos uma chave única
            $chaveUnica = md5(uniqid(""));
            //Aqui renomeamos e movemos o arquivo para o diretório novo Public/Temp/*Pasta variavel*
            $idImagem = $dirNovo . $pasta . '/' . $chaveUnica . '.' . $ext;
            rename($upload, $idImagem);
            //Aqui setamos o caminho que o banco irá receber para que o sistema exiba a imagem corretamente
            $idImagem = 'temp/' . $pasta . '/' . $chaveUnica . '.' . $ext;
            return $idImagem;
        }
    }
}
