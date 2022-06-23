<?php

include_once("utils.php");
include_once("sqlPrinter.php");

$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "nfes"; // Diretório das notas
$files = glob($dir . DIRECTORY_SEPARATOR . "*.xml"); //Validação de arquivos .XML
$cnpjEmit = "09066241000884"; //CNPJ Permitido

$printFormat = "SQL";
$fieldsList = explode(
	";",
	"nota;" .
		"emissao;" .
		"destinatario-cpf;" .
		"destinatario-nome;" .
		"destinario-endereco;" .
		"destinario-numero;" .
		"destinario-bairro;" .
		"destinario-codigo;" .
		"destinario-municipio;" .
		"destinario-cep;" .
		"destinario-pais;" .
		"destinario-email"
);

$printer = new SQLPrinter($fieldsList); //Instância SQLPrinter

$printer->printHeader();
foreach ($files as $file) {
	$xml = simplexml_load_file($file);
	if ($cnpjEmit == $xml->NFe->infNFe->emit->CNPJ && isset($xml->protNFe->infProt->nProt)) { //Validação CNPJ e Número de Protocolo preenchido.
		processXml($xml, $file, $printer);
	}
}

$printer->printFooter();

function processXml(&$xml, &$file, &$printer)
{

	$ide = &$xml->NFe->infNFe->ide; // identificação da NF-e
	$dest = &$xml->NFe->infNFe->dest; // Identificação do Destinatário

	$dtEmissao = isset($ide->dEmi) ? // Versão 2.00 da NFe a data de emissão no elemento dEmi
		$ide->dEmi :
		substr($ide->dhEmi, 0, 10); // Data e Hora de emissão do Documento Fiscal

	$row =
		textField($ide->nNF) .                                  // Número do Documento Fiscal
		textField($dtEmissao) .                                 // Data Emissão
		textField($dest->CPF) .                                 // CPF destinatário
		textField($dest->xNome) .                               // Razão Social ou nome destinatário
		textField($dest->enderDest->xLgr) .                     // Endereço destinatário
		textField($dest->enderDest->nro) .                      // Número endereço destinatário
		textField($dest->enderDest->xBairro) .                  // Bairro destinatário
		textField($dest->enderDest->cMun) .                     // Código Município destinatário
		textField($dest->enderDest->xMun) .                     // Município destinatário
		textField($dest->enderDest->UF) .                       // Estado destinatário
		textField($dest->enderDest->CEP) .                      // CEP destinatário
		textField($dest->enderDest->cPais) .                    // País destinatário
		textField($dest->email);                                // Email Destinatário

	$printer->printRow($row);
}
