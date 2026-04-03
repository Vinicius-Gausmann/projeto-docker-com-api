# 🎮 API de Jogos com Docker

## 📌 Descrição

Este projeto consiste em uma API REST desenvolvida em PHP para gerenciamento de jogos, utilizando um ambiente containerizado com Docker Compose.

A aplicação permite realizar operações CRUD (Create, Read, Update, Delete) em um banco de dados MySQL.

---

## 🐳 Tecnologias Utilizadas

* PHP 8.2 (com Apache)
* MySQL 8.0
* Docker
* Docker Compose

---

## 📂 Estrutura do Projeto

```
projeto-docker/
│
├── docker-compose.yml
├── Dockerfile
│
├── app/
│   └── restfull_api.php
│
└── db/
    └── init.sql
```

---

## 🚀 Como executar o projeto (Deploy)

### 1. Clonar o repositório

```bash
git clone <URL_DO_SEU_REPOSITORIO>
cd projeto-docker
```

---

### 2. Subir os containers

```bash
docker-compose up --build
```

ou em segundo plano:

```bash
docker-compose up -d
```

---

### 3. Acessar a API

Abra no navegador:

```
http://localhost:8080/restfull_api.php/games
```

---

## 📡 Endpoints da API

### 🔹 Listar todos os jogos

```
GET /restfull_api.php/games
```

---

### 🔹 Buscar jogo por ID

```
GET /restfull_api.php/games/{id}
```

---

### 🔹 Criar novo jogo

```
POST /restfull_api.php/games
```

Body (JSON):

```json
{
  "nome": "Celeste",
  "genero": "Plataforma",
  "plataforma": "PC",
  "ano": 2018
}
```

---

### 🔹 Atualizar jogo

```
PUT /restfull_api.php/games/{id}
```

---

### 🔹 Deletar jogo

```
DELETE /restfull_api.php/games/{id}
```

---

## 🗄️ Banco de Dados

O banco de dados é criado automaticamente ao subir os containers, com a tabela:

* `games`

  * id
  * nome
  * genero
  * plataforma
  * ano

---

## 🧠 Observações

* O sistema utiliza Docker para garantir portabilidade e facilidade de execução.
* A API segue o padrão REST.
* A comunicação entre containers é feita via Docker Network.

---

## 👨‍💻 Autor

Projeto desenvolvido como atividade acadêmica para a disciplina cloud e cs, por vinicius gausmann.
