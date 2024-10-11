# Teste Técnico - Picpay Simplificado 

API Restful desenvolvida com **PHP**, utilizando **Laravel**. O objetivo da aplicação é emular o fluxo de uma transação entre dois usuários.

Link do repositório explicando o teste: (https://github.com/PicPay/picpay-desafio-backend). 

## Tecnologias utilizadas 

-PHP\
-Laravel\
-MySql\
-Sanctum\
-Insomnia\
-Git

## Endpoints

1. `POST /login`

  - **Descrição**: Autentica o usuário.
  - **Corpo**:
  ```json
  {
    "email": "example@gmail.com",
    "password": "userPassword123"
  }
  ```

  
2. `POST /logout`

  - **Descrição**: Destrói o token de autenticação do usuário.
  - **Corpo**:
  ```json
  {
    "email": "example@gmail.com",
    "password": "userPassword123"
  }
  ```
3. `POST /transfer`

  - **Descrição**: Faz a transação entre dois usuários.
  - **Corpo**:
  ```json
{
	"payer": "9d337829-5de1-489d-9612-9dd4f584054e",
	"payee": "9d337829-4cae-436c-97c5-c120532a2e61",
	"value": 10
}
  ```

##  Mudanças

Tendo como base o teste citado, tomei decisões com o intuito de expandir a API desenvolvida. Algumas adições foram:

-**Uuid**: Utilização de Uuid para as chaves primárias com o intuito de melhorar a segurança.\
-**Autenticação**: Autenticação de usuários com o **Laravel Sanctum**. Onde apenas quem está autenticado pode fazer a transação.\
-**E-Mail**: No teste tem um simulador de envio de e-mail, porém o mesmo aparenta não estar ativo. Por esse motivo não foi implementado
