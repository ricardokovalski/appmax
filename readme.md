## Sobre o sistema

Este sistema foi desenvolvido utilizando PHP (7.1.16) e MySql (5.7.21).

Após realizar o clone do repositório, digite o comando abaixo na raíz do projeto:

```composer install```

Depois que terminar a instalação, rode o camando abaixo para criar o arquivo .env

```cp .env.example .env```

E posteriormente rode o comando abaixo para gerar a key da sua aplicação:

```php artisan key:generate```

Após configure um banco de dados e preencha os dados de acesso do mesmo no arquivo .env e em seguida rode as migrations com o seguinte comando:

```php artisan migrate```

Para criar dados de teste, rode o comando abaixo:

```ptp artisan db:seed```

##Acessando o Painel

Para acessar o painel de produtos, entre com os dados:

```
E-Mail Address: master@gmail.com
Password: 123456
```

## O painel

O painel possui as seguintes funções:

- Listagem de produtos
- Cadastro de produtos
- Edição de produtos
- Exclusão de produtos
- Dar baixa na quantidade por produto
- Página de relatórios diários 

## A Api

A Api possui dois endpoints que são>

- ver-produtos (retorna um json com todos os produtos)
- baixar-produtos (remove um ou mais produtos)
- adicionar-produtos (cadastra um ou mais produtos)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
