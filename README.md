<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Base Laravel Ideal Trends

#### Sobre o Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

###### Requisitos


    * PHP> = 7.1.3
    * Extensão PHP OpenSSL
    * Extensão PHP PDO
    * Extensão PHP Mbstring
    * Extensão PHP Tokenizer
    * Extensão PHP XML
    * Extensão PHP Ctype
    * Extensão PHP JSON
    * Web Service (Apache e Nginx)
    * php.ini com max_input_vars = 10000

###### Requisitos do Laravel Tanancy

    * Laravel 5.6 or 5.7.
    * PHP 7.1 or up.
    * MySQL 5.7+, MariaDB 10.1.13+ or PostgreSQL 9+.
    * Optionally Apache 2.4+ or Nginx 1.12+.

#### Recursos

- IdealUI
    * Com ele podemos utilizar o JavaScript e CSS fornecido pelo nosso colega Pedro, nele possui padronização de codigo e função prontas para nos auxiliar, para saber mais ler a documentação do IdealUI
- Versionated Helper
    * Para utilizar o versionamento adicioar `{{vAsset(path)}}` invés de `{{asset(path)}}` ele irá pegar a versão do git, matenha sempre o versionamento correto com tags exemplo : `v1.12.3`

- ACL, ACL view, ACL menu, ACL Agent
    * Autoriza usuários em determinadas rotas de acordo com as permissões setadas no banco. 
    Politica validadora de acessos e visualização de recursos (ACL view) Valida se o usuário logado tem permissão a determinadas ações utilizando o @can nas views. 
    É necessário passar o nome completo da rota registrada na tabela de rotas_permissoes.
    `Exemplo: @can('acl.view', 'admin.administradores.destroy') <button>Deletar Administrador</button> @endcan`,  mais detalhes no arquivo app/Providers/AuthServiceProvider.php 


Feito para agilizar a produção e padronização

###### Responsáveis

Toda a equipe de desenvolvimento está trabalhando no desenvolvimento desse repositório, quando possivel atualizamos os repositorios para ajudar a todos

###### Virtual Host

    <VirtualHost *:80>
        ServerAdmin webmaster@site.com.br
        ServerName app.PROJETO.localhost
        DocumentRoot /var/www/PROJETO/public
    
        <Directory /var/www/PROJETO/public/>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>
    
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
    
    # vim: syntax=apache ts=4 sw=4 sts=4 sr noet

###### Instalação

* git clone git@bitbucket.org:idealtrends/base-greeva-laravel.git
* Valide se o apache possui permissão no diretorio
* Valide se as permissões das pastas dentro de *storage/** possuem a permissão 777 local ou 775 no servidor
* rode o composer install
* crie o banco de dados e configure o arquivo *.env* na raiz do projeto com todas as informações necessárias
* Veirifcar se existe conteúdo dentro da pasta public/idealui, caso não exista rode novamente o *composer install* ou clone o repositório respectivo ao projeto

###### Configurar o ambiente Local, Develop

Após a instalação dos itens acima, será necessário adicionar ao arquivo /etc/hosts o seguinte linha: 
```
127.0.0.1   base-greeva-laravel.localhost
```
Configure seu [Virtual Host](https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-16-04#step-four-—-create-new-virtual-host-files) com o host app.clinicaideal.localhost
```xml
<VirtualHost *:80>
	ServerAdmin webmaster@site.com.br
	ServerName PROJETO.localhost
	DocumentRoot /var/www/html/PROJETO/public

	<Directory /var/www/html/PROJETO/public/>
		Options Indexes FollowSymLinks
		AllowOverride All
		Require all granted
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
```
###### Configurar o ambiente Local, Develop laravel artisan

    * php artisan serve
    
###### Pós Instalação e configuração

    * php artisan migrate --seed
    * php artisan storage:link
    * npm install

### Licensa

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Utéis

    * https://pt.wikipedia.org/wiki/Lista_de_c%C3%B3digos_de_estado_HTTP
    * https://github.com/orangehill/iseed
    * https://github.com/reliese/laravel
    * https://github.com/jenssegers/agent
    * https://laravel-tenancy.com/
        
