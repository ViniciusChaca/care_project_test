# Projeto Care - Vinicius Ferreira
Projeto de gerenciamento de notas fiscais.

### Instalação
A instalação/configuração é baseada em Shell Script.

```bash
chmod +x config-system.sh
sh config-system.sh
```
O processo de instalação irá:
1. Configurar permissões e grupos
2. Substituir arquivos de configuração do Apache

### Ambiente de execução local (Docker)
O ambiente de execução (desenvolvimento e testes) é montado usando o Docker.

#### Construção do Docker
O arquivo Devcontainer.json e Dockerfile contém as instruções para o Docker montar o container do projeto.

#### Execução do container
Com as opções do VSCODE ("F1") será possível reabrir o ambiente diretamente no Container já configurado.
1. Necessário o Plugin VSCODE Remote Containers.
2. Apertar F1 para opções.
3. Remote-Containers: Reopen in Container

### Apache
É necessário inicializar o Apache.

```bash
service apache2 start
```
