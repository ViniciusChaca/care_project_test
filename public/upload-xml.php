<?php
if (isset($_POST['enviar-formulario'])) {
    $formatosPermitidos = array("xml", "XML");                                               // Formatos permetidos
    $cnpjEmit = "09066241000884";                                                           // CNPJ Permitido
    $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);                   // Extrai a extensão do arquivo
    $xml = simplexml_load_file($_FILES['arquivo']['tmp_name']);

    if (in_array($extensao, $formatosPermitidos) && $cnpjEmit == $xml->NFe->infNFe->emit->CNPJ && isset($xml->protNFe->infProt->nProt)) {
        $pasta = dirname(__FILE__) . DIRECTORY_SEPARATOR . "../app/nfes/";                  // Diretório destino
        $temporario = $_FILES['arquivo']['tmp_name'];
        $novoNome = uniqid() . ".$extensao";                                                  // Novo nome do arquivo
        if (move_uploaded_file($temporario, $pasta . $novoNome)) {
            echo '<script>alert("Upload feito com sucesso")</script>';
            echo '<script>window.location.href="index.php"</script>';
        } else {
            echo '<script>alert("Erro, não foi possível fazer o upload")</script>';
            echo '<script>window.location.href="index.php"</script>';
        }
    } else {
        echo '<script>alert("Formato Inválido e/ou CNPJ inválido")</script>';
        echo '<script>window.location.href="index.php"</script>';
    }
}
