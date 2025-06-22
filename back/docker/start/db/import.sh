# Import des fichiers JSON
mongoimport --username "$MONGO_INITDB_ROOT_USERNAME" \
            --password "$MONGO_INITDB_ROOT_PASSWORD" \
            --authenticationDatabase admin \
            --db "$MONGO_INITDB_DATABASE" \
            --collection burgers \
            --file /docker-entrypoint-initdb.d/burgers.json \
            --jsonArray

mongoimport --username "$MONGO_INITDB_ROOT_USERNAME" \
            --password "$MONGO_INITDB_ROOT_PASSWORD" \
            --authenticationDatabase admin \
            --db "$MONGO_INITDB_DATABASE" \
            --collection drinks \
            --file /docker-entrypoint-initdb.d/drinks.json \
            --jsonArray

mongoimport --username "$MONGO_INITDB_ROOT_USERNAME" \
            --password "$MONGO_INITDB_ROOT_PASSWORD" \
            --authenticationDatabase admin \
            --db "$MONGO_INITDB_DATABASE" \
            --collection ingredients \
            --file /docker-entrypoint-initdb.d/ingredients.json \
            --jsonArray

# Création des collections utilisateurs et commandes
mongosh --username "$MONGO_INITDB_ROOT_USERNAME" \
      --password "$MONGO_INITDB_ROOT_PASSWORD" \
      --authenticationDatabase "admin" \
      --eval "
        db = db.getSiblingDB('$MONGO_INITDB_DATABASE');
        db.createCollection('users');
        db.createCollection('orders');
      "
