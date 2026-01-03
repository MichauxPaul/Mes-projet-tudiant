import mysql from "mysql2/promise";

let connection;

//fonction pour se connecter a la bd
export function getConnection() {
  if (!connection) {
    connection = mysql.createPool({
      port: 3306,
      host: "timmatane.ca",
      user: "tim_michauxp",
      password: "6vDFMDy8n3",
      database: "tim_michauxp",
      connectionLimit: 20,
    });
  }

  if (connection) {
    console.log("Connexion au serveur MYSQL réussie");
  }

  return connection;
}
