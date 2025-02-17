# Desafio Técnico Clarifiquei: Guia de Execução

Bem-vindo ao projeto! Este guia foi preparado para te ajudar a rodar o projeto facilmente, explicando todos os passos necessários.

## Pré-requisitos

- **PHP 7.4+**  
- **Composer**  
- **Servidor Local (ex: Laragon, WAMP, XAMPP)**  
- **Banco de Dados MySQL** (ou outro de sua preferência)

## Instalação

1. **Obtenha os Arquivos do Projeto**  
   Clone o repositório ou copie os arquivos para a pasta:  
   `c:/laragon/www/Clarifiquei`

2. **Instalar as Dependências**  
   Abra o terminal, navegue até a pasta do projeto e execute:
   ```
   composer install
   ```
   Isso garantirá que todas as bibliotecas necessárias sejam baixadas e configuradas.

3. **Configurar o Banco de Dados** 
   - Copie e renomie o arquivo .env.example para .env
   - Crie um banco de dados no MySQL e ajuste as configurações necessárias (hostname, usuário, senha, nome do banco) no arquivo .env do projeto.

Após ajustar as suas configurações, considere importar o arquivo **database.sql**, presente na raíz do projeto.

## Execução

1. **Inicie o Servidor Local**  
   Se estiver usando o Laragon, inicie-o e acesse:
   ```
   http://localhost/Clarifiquei
   ```
   Assim, o projeto estará disponível no seu navegador.

2. **Acessar o Sistema**  
   - Na index(página principal) poderá fazer login para entrar no sistema.
   - Após o login, você poderá gerenciar engenheiros e tarefas, ver relatórios e muito mais.

Por padrão, o login e senha são os seguintes:
- Email: admin@email.com
- Senha: admin123

## Pontos Importantes

- **Gerenciamento de Sessões:**  
  O sistema usa a biblioteca Phession para controlar as sessões dos usuários. Certifique-se de que o PHP esteja configurado corretamente para trabalhar com sessões.

- **Alocação de Tarefas:**  
  A lógica de alocação de tarefas foi projetada para distribuir as tarefas de forma equilibrada entre os engenheiros, com tratamento para casos de overload utilizando um mecanismo de fallback.

- **Interface Modernizada:**  
  Utilizamos Bootstrap para uma interface responsiva, Font Awesome para ícones modernos e Chart.js para exibir os relatórios de alocação de forma visualmente agradável.

## Dicas Úteis

- Se ocorrerem erros, verifique os logs do PHP e o console do navegador para detalhes.
- Altere as configurações conforme necessário para adaptar o projeto ao seu ambiente.


