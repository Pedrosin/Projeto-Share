# Projeto-Share
Projeto Final de Formação no curso de informática pelo CTI Bauru

Para utilização do software é necessário instalar os programas abaixo

Versão mais recente do Git
composer ^2.4
XAMPP ^8.1 / ^PHP 8.1
Depois da instalação do XAMPP, é necessário habilitar a extesão GD no arquivo php.ini seguindo o passo a passo abaixo:

Inicie o XAMPP, procure por Apache -> Config
Clique na opção PHP (php.ini)
Remova o ; da linha: ;extension=gd e salve o arquivo.

# Configurações do projeto
Depois que o repositório estiver clonado, é necessário instalar as dependências do projeto. Navegue até a pasta raiz do projeto, e digite na linha de comando composer update

Como o projeto faz o uso de um provedor de e-mail, banco de dados, servidor FTP e autorizadores do Github e do Google, é necessário configurar algumas credenciais para que a aplicação possa funcionar corretamente. Disponibilizamos o arquivo .env.example para que você tenha uma ideia de como configurá-lo. Lembre-se é necessário criar um o arquivo .env na raiz do projeto com todas as informações do arquivo .env.example.

#Iniciando o projeto
Para iniciar o projeto é necessário rodar os comandos abaixo na linha de comando ao menos uma vez, exceto o _php artisan serve_ que sempre deve ser executado para iniciar a aplicação.

<p>php artisan route:clear</p>
<p>php artisan key:generate</p>
<p>php artisan db:seed</p>
<p>php artisan serve</p>
