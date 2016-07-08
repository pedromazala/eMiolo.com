# eMiolo.com

Teste proposto pela empresa [**eMiolo.com**](http://emiolo.com) ao desenvolvedor Pedro Mázala com o intuito de testar os conhecimentos do mesmo.

### 1. Clonando o projeto 

Para dar início ao proto é necessário cloná-lo isso é possível executando o sente comando:
```shell
$ git clone https://github.com/pedromazala/eMiolo.com.git {EXPECTED_DIR}
$ cd {EXPECTED_DIR}
```

### 2. Criando a chave do projeto

Antes executar o projeto é necessário criar uma chave para o mesmo. Conseguimos fazer isso rodando o seguinte comando:  
```shell
$ php artisan key:generate
```

### 3. Configurando o arquivo .env

O arquivo `.env` é reponsável por manter diversas configurações, incluindo configurações de bancos de dados.
Na raiz do projeto será necessário fazer uma cópia do arquivo de exemplo e editar os dados de acordo com seu ambiente.

O laravel traz como padrão o arquivo `.env.example` o qual podemos copiar e alterar da forma que desejarmos. 
A cópia pode ser feita através do comando:
```shell
$ cp .env.example .env
```
E, após isso, editar as configurações do banco de dados de acordo com seu ambiente.

### 4. Instalação do banco de dados

Nesta etapa poderemos seguir por dois caminhos:
1. Executar os migrations presentes no projeto
2. Importar o DUMP do banco que está no projeto

#### 4.1 Executar os migrations presentes no projeto

Depois de termos executado as alterações do arquivo de configuração, podemos rodar os comandos:
```shell
$ php artisan migration:install
$ php artisan migration
```

Que irão criar a tabela migrations e as tabelas users e passwd_resets, respectivamente, no seu banco de dados configurado.

O primeiro usuário do sistema pode ser inserido na rota `/register` do projeto.


#### 4.2 Importar o DUMP do banco que está no projeto

É possível importar o DUMP do banco que está no path `{EXPECTED_DIR}/storage/database/bigBang.sql`

Este DUMP já vai com o usuário admin@eMiolo.com com a senha 123456

### 5. Executando o projeto

Com o console no diretório do projeto execute o comando:
```shell
$ php artisan serve
```

O projeto estará disponível na URL [http://localhost:8000/](http://localhost:8000/)