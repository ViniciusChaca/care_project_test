<?php
if (isset($_POST['listar'])) {
    $dir = "/workspaces/care_project/app/nfes"; // Diretório das notas
    $files = glob($dir . DIRECTORY_SEPARATOR . "*.xml"); //Validação de arquivos .XML
    $cnpjEmit = "09066241000884"; //CNPJ Permitido

    // Montagem do HTML da Tabela
    $table  = '<head><link rel="stylesheet" href="./styles/global.css"></head>';
    $table .= '<table id="NFe">';
    $table .= '<thead>';
    $table .= '<tr>';
    $table .= '<td>Número do Documento Fiscal</td>';
    $table .= '<td>Data Emissão</td>';
    $table .= '<td>CPF destinatário</td>';
    $table .= '<td>Razão Social</td>';
    $table .= '<td>Endereço destinatário</td>';
    $table .= '<td>Número endereço</td>';
    $table .= '<td>Bairro destinatário</td>';
    $table .= '<td>Código Município</td>';
    $table .= '<td>Município destinatário</td>';
    $table .= '<td>Estado destinatário</td>';
    $table .= '<td>CEP destinatário</td>';
    $table .= '<td>País Destinatário</td>';
    $table .= '<td>Email Destinatário</td>';
    $table .= '<td>Valor da Nota</td>';
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>';


    foreach ($files as $file) {
        $xml = simplexml_load_file($file);
        $ide = &$xml->NFe->infNFe->ide; // Identificação da NF-e
        $dest = &$xml->NFe->infNFe->dest; // Identificação do Destinatário
        $total = &$xml->NFe->infNFe->total->ICMSTot; //Valores da Nota

        $dtEmissao = isset($ide->dEmi) ? // Na versão 2.00 da NFe a data de emissão está no elemento dEmi
            $ide->dEmi :
            substr($ide->dhEmi, 0, 10); // Data e Hora de emissão do Documento Fiscal

        // Validação CNPJ e Número de Protocolo preenchido.
        if ($cnpjEmit == $xml->NFe->infNFe->emit->CNPJ && isset($xml->protNFe->infProt->nProt)) {
            $table .= '<tr>';
            $table .= "<td>{$ide->nNF}></td>";
            $table .= "<td>{$dtEmissao}</td>";
            $table .= "<td>{$dest->CPF}</td>";
            $table .= "<td>{$dest->xNome}</td>";
            $table .= "<td>{$dest->enderDest->xLgr}</td>";
            $table .= "<td>{$dest->enderDest->nro}</td>";
            $table .= "<td>{$dest->enderDest->xBairro}</td>";
            $table .= "<td>{$dest->enderDest->cMun}</td>";
            $table .= "<td>{$dest->enderDest->xMun}</td>";
            $table .= "<td>{$dest->enderDest->UF}</td>";
            $table .= "<td>{$dest->enderDest->CEP}</td>";
            $table .= "<td>{$dest->enderDest->cPais}</td>";
            $table .= "<td>{$dest->email}</td>";
            $table .= "<td>{$total->vNF}</td>";
            $table .= '</tr>';
        }
    }
    // Fechamento HTML
    $table .= '</tbody>';
    $table .= '</table>';

    // Exibição HTML
    echo $table;
}
