<p align="left">Api de provas de corridas criada em Laravel 5.7</p>


<p>Após clonar o repositório executar o comando:</p>
<pre>composer update</pre>

<p>Criar a base de dados:</p>
<pre>CREATE DATABASE desafio</pre>

<p>Criar o arquivo .env e inserir as credenciais de conexão à base de dados:</p>

<p>Rodar o comando:</p>
<pre>php artisan migrate</pre>

<p>Endpoints:</p>
<pre>http://desafio.prod/api/v1/races</pre> No Method GET lista os tipos de provas cadastradas - 
No Method POST cadastra o tipo de prova
<pre>http://desafio.prod/api/v1/runners</pre> Lista 
<pre>http://desafio.prod/api/v1/runners-races</pre>
<pre>http://desafio.prod/api/v1/runners-result</pre>
<pre>http://desafio.prod/api/v1/races-listing-by-age</pre>
<pre>http://desafio.prod/api/v1/races-listing-by-age</pre>
