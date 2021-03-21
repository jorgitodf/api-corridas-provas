<h3 align="left">Api de provas de corridas criada em Laravel 5.7</h3>


<p><b>1</b> - Após clonar o repositório executar o comando:</p>
<pre>composer update</pre>

<p><b>2</b> - Criar a base de dados:</p>
<pre>CREATE DATABASE desafio</pre>

<p><b>3</b> - Criar o arquivo .env e inserir as credenciais de conexão à base de dados:</p>

<p><b>4</b> - Rodar o comando:</p>
<pre>php artisan migrate</pre>

<p><b>5</b> - Endpoints:</p>
<pre>http://desafio.prod/api/v1/races -> GET lista os tipos de provas cadastradas - POST cadastra o tipo de prova</pre>
<pre>http://desafio.prod/api/v1/runners -> GET lista os corredores cadastrados - POST cadastra novo corredor</pre>
<pre>http://desafio.prod/api/v1/runners-races -> POST cadastra o corredor e o seu tipo de prova</pre>
<pre>http://desafio.prod/api/v1/runners-result -> POST cadastra o resultado da prova de cada corredor</pre>
<pre>http://desafio.prod/api/v1/races-listing-by-age -> GET lista o resultado das provas por grupo de idade e em ordem de classificação</pre>
<pre>http://desafio.prod/api/v1/races-listing-by-age -> GET lista o resultado das provas gerais por tipo de prova e em ordem de classificação</pre>
