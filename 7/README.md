### Descrição

REST API simples criada em php para exemplificação do conceito principal por trás do funcionamento. Para simplificar não usaremos rotas amigáveis, validações complexas e mensagens de erros mais elaboradas, além de métodos de requisição do tipo PUT e DELETE, deixando todas as ações por conta de GET e POST. Para testar as requisições recomenda-se o uso de programas como o [Postman](https://www.postman.com/ "Postman") ou o [Insomnia](https://insomnia.rest/ "Insomnia").

### Compatibilidade
PHP >=  7.0
                    
###Endpoints

| Método | Rota | Descrição |
| ------------- | ------------------------------ |
| GET | `/users`      | Obtém a lista de todos os usuários. |
| POST | `/users/add`   | Insere um usuário. |
| POST | `/users/{email}/update`      | Atualiza os dados de um usuário. |
| POST | `/users/{email}/delete`      | Remove um usuário da lista. |


###Campos

- Válido para inserção e edição de usuários

| Nome do campo  | Descrição do campo | Obrigatório |
| ------------- | ------------- |
| `first_name`  | Nome do usuário  | Sim |
| `last_name`  | Sobrenome do usuário  | Sim |
| `email`  | E-mail do usuário  | Sim |
| `phone`  | Telefone do usuário  | Sim |

                    
###Acesso
Para acessar o endpoint passamos o valor em uma query-var chamada **route**
- ?route=`caminho_da_rota`

###Exemplos de uso
**Listando todos os usuários**

`GET` localhost/candt/example7/?route=/user

-------------
**Inserindo um novo usuário**

`POST` localhost/candt/example7/?route=/user/add

{
	"first_name": "Foo",
	"last_name": "Baar",
	"email": "example@example.com",
	"phone": "(99) 99999-9999"
}

-------------
**Editando um usuário**

`POST` localhost/candt/example7/?route=/user/example@example.com/update

{
	"first_name": "Foo",
	"last_name": "Baar",
	"email": "example@example.com",
	"phone": "(99) 99999-9999"
}

-------------
**Removendo um usuário**

`POST` localhost/candt/example7/?route=/user/example@example.com/update

                    
###Armazenamento

Os dados são armazenados no arquivo `registros.txt`, na raiz da pasta.

_Obs: Para excluí-los apenas limpe ou remova o arquivo._