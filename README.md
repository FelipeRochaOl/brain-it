# Test Brain IT PHP - Vue

## Dependencias
 - Docker
 - Docker compose

Run to install the project with docker-compose

```sh
docker-compose up -d --build --no-cache
```

Run to inicialize the project

```sh
docker-compose up -d
```

Vue.js + PHP - Regras de negócios:

A ideia é testar os conhecimentos de maneira simples desenvolvendo uma funcionalidade para gerenciar produtos.
Instruções:

  ● Cadastrar produto:

    ○ - Campos: nome, descrição, preço, categoria

  ● Listagem de produtos:

    ○ - Cabeçalho da tabela: #, Nome, Preço, Categoria, Ações
    ○ - Na coluna ações da tabela deve ter 2 botões, um para editar e outro para
    excluir

  ● Editar produto:

    ○ - Campos: nome, descrição, preço, categoria
    ○ - Regras:
      ■ - FRONT
        ● Campos preenchidos com as informações atuais
  
  ● Excluir produto: 

    ○ - Regras:
      ■ - FRONT
        ● - Mostrar modal para confirmar a exclusão

Tecnologias:

● backend: PHP (Utilizar Laravel)

● Banco de Dados: MySQL

● Front: Vue.js (para o css pode utilizar o bootstrap)

> Importante
>> Na pasta postman temos a collection com as chamadas da API


Diferenciais:
Utilizar docker, utilizar vuex no Vue.js.


#### Development: Felipe Rocha Oliveira
#### Email: feliperochaoliveira@gmail.com