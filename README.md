# L5 SWAPI - Aplicação Web Star Wars API

Este é um projeto que consome dados da API de Star Wars e exibe um catálogo de filmes, com a possibilidade de visualizar detalhes de cada um. Ele foi desenvolvido utilizando **PHP 7.4**, **MySQL**, **JavaScript**, **HTML** e **CSS**.

## Instruções de Instalação

### 1. Preparação do Ambiente

1. **Clone ou extraia os arquivos do projeto** para uma pasta de sua preferência.
Para clonar o repositório, você pode utilizar o seguinte comando no terminal:
   ```bash
   git clone https://github.com/JeanCSF/teste_swapi_l5.git
   ```

2. **Configuração do Banco de Dados**:
   - Importe o dump do banco de dados `l5_swapi.sql` para o seu banco MySQL.
   - A tabela `logs` será preenchida automaticamente conforme a API for executada.

### 2. Subir o Servidor PHP

1. **Subir o servidor PHP** na pasta raiz do projeto executando o seguinte comando no terminal:

   ```bash
   php -S localhost:8000 -t public
   ```

   - O servidor será iniciado na URL `http://localhost:8000`, mas você pode escolher qualquer outra porta disponível no seu ambiente local.

2. **Acessando a Aplicação**:
   - Após iniciar o servidor, abra seu navegador e acesse `http://localhost:8000` para visualizar o catálogo de filmes.

### 3. Melhorias Aplicadas

1. **Internacionalização(i18n)**: Como o idioma da api utilizada neste projeto é inglês, implementei um esquema simples de internacionalização(pt/en) para a tradução da aplicação, permitindo que o usuário escolha o idioma desejado. Tornando fácil também a adição de novos idiomas na aplicação.
2. **Filtros e Ordenação**: A aplicação oferece a possibilidade de filtrar filmes com base em diversos critérios, como `title`, `date_asc`, `date_desc`, `ep_asc`, e `ep_desc`.
3. **Pesquisa por Filmes**: A aplicação oferece a possibilidade de pesquisar filmes pelo titulo deles.
4. **Páginas de erro especificas**: A aplicação possui duas páginas de erro, uma para erros 404 e outra para erros 500.
5. **Documentação**: A aplicação possui uma rota `/docs` que exibe a documentação da API.

### 4. Descrição do Teste

Utilizando a api do Star Wars como fonte de informação, construa uma tela web com um catálogo, contendo todos os filmes, ordenados por data de lançamento, exibindo nome e data de lançamento de cada um.✔

 

Ao clicar em um dos filmes, deverá ser exibido:

- Nome;✔

- Nº episódio;✔

- Sinopse;✔

- Data de lançamento;✔

- Diretor(a);✔

- Produtor(es);✔

- Nome dos personagens;✔

- A idade dos filmes em anos, meses e dias.✔

 

URLs da api do Star Wars, escolha uma para utilizar no seu projeto:

                https://swapi.dev/

                https://swapi.py4e.com/✔

                https://www.swapi.tech/

                https://swapi-node.vercel.app/

 

O layout da aplicação pode ser criado por você.

Faça as exibições em telas distintas, deverá ser possível acessar os detalhes e voltar ao catálogo de filmes.✔

Em seu backend, crie uma api para consumir a api do Star Wars, podendo utilizar a biblioteca cURL, por exemplo.✔

A idade dos filmes deverá ser calculada no backend.✔

Seu frontend deve fazer requisições para sua própria api local.✔

Crie endpoints distintos para cada tipo de requisição.✔

A cada vez que houver interação com a api do projeto, guarde um log na base de dados com dados como:

   - data/hora✔

   - solicitação realizada✔

 

Você poderá utilizar das seguintes linguagens: php, mysql, javascript, html e css.✔

 

Você poderá:

   - Usar a criatividade e criar mais três features que não estão nesta descrição;✔

   - Utilizar o banco para guardar mais informações, caso tenha necessidade, como erros de retorno da api, por exemplo;✔

   - Estruturar o projeto no padrão MVC.✔

## IMPORTANTE:

1. Utilizar o PHP 7.4;

2. Utilizar Programação Orientação a Objeto;

3. Você não poderá utilizar frameworks no PHP, o código terá de ser 100% seu. No frontend você poderá utilizar JQuery e Bootstrap somente;

4. Ao concluir o teste, deverá ser encaminhado um arquivo compactado (.zip, .rar, ...) contendo:

- Todo o código fonte;

- Dump da base de dados;

- Criar uma pasta dentro do seu projeto contendo:

  - Instruções de instalação detalhadas;

  - Documentação de uso da sua api;

  - Lista das melhorias aplicadas.