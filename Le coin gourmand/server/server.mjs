import express from "express";
import cors from "cors";

const port = 3005;
const hostname = "127.0.0.1";

//création de l'instance du serveur
const server = express();

//dire a express qu'on va recevoir du json
server.use(
  express.json({
    limit: "50mb",
  })
);

//utiliser cors
server.use(cors());

//dire a express d'utiliser notre route
import items from "./routes/RecetteSQL.mjs";
server.use("/recettes", items);

//recupere tout ce qui est non existant
server.all("/*splat", (req, res) => {
  res
    .status(404)
    .json({ success: false, message: "Ressource non trouvée", data: null });
});

//lancer le serveur
server.listen(port, hostname, () => {
  console.log(`Serveur lancé : http://${hostname}:${port}`);
});
