# 🐔 El pollo

## 🍔 About
This project is a burger and drinks project made by [Raphaël AZEVEDO](https://github.com/RaphaelAZ) and [Félix VIART](https://github.com/ViartFelix).
It has a full authentification system (via JWT), and an ordering of food system. To store values, this project uses MongoDB

This project has been made with the following technologies:

### Front-end

All of those technologies bellow can be found in the ``el-pollo-front/package.json`` file.

- VueJS (V3) + Vue Routeur
- Vuetify
- Axios
- Iconify
- TypeScript

### Back-end (API)

All of those technologies bellow can be found in the ``back/composer.json`` file.

- PHP V8.2 (8.3/8.4 - compatible)
- MongoDB
- Docker
- DotEnv
- JWT

## 🍟 Install

### Back-end

To install the back-end, you will need:
- superuser privileges (if you are on Linux) (or not if you are on windows)
- docker cli
- composer
- a little bit of patience

After that, you'll need to rename the ``.env.exemple`` file into ``.env`` located in the ``back/`` directory, and fill it with values.

An example configuration could be the following:
```dotenv
MONGO_USERNAME="admin" # Please change for a better user !
MONGO_PASSWORD="password" # Please change for a stronger password !
# Not the container mongo port
MONGO_PORT=17017
MONGO_DB="el_polo_db"
MONGO_HOST="mongo"

DB_CONTAINER_NAME="db_container"

PGADMIN_MAIL="admin@elpollo.com"
PGADMIN_PW="admin" # Please change for a stronger password !

JWT_SECRET="(your token here)"
```

Then, run the following commands (from the root of the project):

```shell
cd back
composer install --ignore-platform-reqs
sudo docker compose up --build
```

*Be patient, as the build process of the Docker image can take a while (~4 minutes). You can follow the next section to gain a little bit of time*

### Front-end

To install the front-end, you will need:
- NPM

Then, run the following commands (from the root of the project):
```shell
cd el-pollo-front
npm i
npm run dev
```

Now, you can go to http://localhost:5173/home to enjoy the projet !
Thank you for using our project ! :)

<hr />

*Pro tip: There is no user in the base, so you'll have to create an account to access all features of the project !*
