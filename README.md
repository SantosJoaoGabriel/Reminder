## Projeto Lembretes

Sistema web para gerenciamento de lembretes, desenvolvido usando Laravel 12. Permite ao usuário criar, visualizar, editar e excluir lembretes, vinculando informações como título, descrição, data e previsão do clima para o dia selecionado. O sistema utiliza autenticação para garantir segurança no acesso e inclui integração com uma API de previsão do tempo.

## Tecnologias Utilizadas
- Laravel 12

- PHP 8.2

- MySQL (banco de dados)

- Blade (templates)

- Tailwind CSS (estilos)

- API WeatherAPI (previsão do tempo)

- Composer (gerenciador de dependências)

- NPM (gerenciador de pacotes front-end)


## Passos para Instalação e Execução
Clonar o repositório

```
git clone https://github.com/SantosJoaoGabriel/Reminder.git
```

```
composer install
npm install
```

Gerar chave da aplicação

```
php artisan key:generate
Executar migrações
```

```
php artisan migrate
```

## Configurações da API

Em https://www.weatherapi.com faça registro e gera uma chave para API.

Copie .env.example para .env e ajuste variáveis (DB, API de clima, etc).

Exemplo para API:
WEATHER_API_KEY=SuaChaveApi
