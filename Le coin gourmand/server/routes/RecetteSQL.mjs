import express from "express";
import { getConnection } from "../mysql.mjs";

const mysqlConn = getConnection();
const table = "RecetteCuisine";

const router = express.Router();


// GET : récupérer toutes les recettes

router.get("/all", async (req, res) => {
  try {
    const [result] = await mysqlConn.query(`SELECT * FROM ${table}`);
    res.status(200).json({
      success: true,
      message: "Recettes récupérées avec succès",
      data: result,
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error, data: null });
  }
});



// POST : ajouter une nouvelle recette

router.post("/add", async (req, res) => {
  const RC_Titre = req.body.RC_Titre || "NOM PAR DEFAUT";
const RC_Description = req.body.RC_Description || "DESCRIPTION PAR DEFAUT";
const RC_Temps = req.body.RC_Temps || 45;
const RC_Image = req.body.RC_Image || "IMG BASE 64 PAR DEFAUT";
const RC_Ingredient = req.body.RC_Ingredient || "INGREDIENT PAR DEFAUT";
const RC_Etape = req.body.RC_Etape || "ETAPE PAR DEFAUT";


  try {
    await mysqlConn.query(
      `INSERT INTO ${table} 
      (RC_Titre, RC_Description, RC_Temps, RC_Image, RC_Ingredient, RC_Etape)
      VALUES (?, ?, ?, ?, ?, ?)`,
      [RC_Titre, RC_Description, RC_Temps, RC_Image, RC_Ingredient, RC_Etape]
    );

    res.status(200).json({
      success: true,
      message: "Nouvelle recette insérée avec succès",
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({ success: false, message: error });
  }
});



// PUT : modifier une recette existante

router.put("/edit/:id", async (req, res) => {
  const id = parseInt(req.params.id);

  if (isNaN(id)) {
    return res.status(400).json({
      success: false,
      message: "ID incorrect",
    });
  }

  const RC_Titre = req.body.RC_Titre || "NOM PAR DEFAUT";
const RC_Description = req.body.RC_Description || "DESCRIPTION PAR DEFAUT";
const RC_Temps = req.body.RC_Temps || 123;
const RC_Image = req.body.RC_Image || "IMG BASE 64 PAR DEFAUT";
const RC_Ingredient = req.body.RC_Ingredient || "INGREDIENT PAR DEFAUT";
const RC_Etape = req.body.RC_Etape || "ETAPE PAR DEFAUT";


  try {
    const [result] = await mysqlConn.query(
      `UPDATE ${table} SET 
        RC_Titre = ?, 
        RC_Description = ?, 
        RC_Temps = ?, 
        RC_Image = ?, 
        RC_Ingredient = ?, 
        RC_Etape = ?
      WHERE RC_Id = ?`,
      [RC_Titre, RC_Description, RC_Temps, RC_Image, RC_Ingredient, RC_Etape, id]
    );

    if (result.affectedRows === 0) {
      return res.status(404).json({
        success: false,
        message: "Recette non trouvée",
      });
    }

    res.status(200).json({
      success: true,
      message: "Recette modifiée avec succès",
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error });
  }
});



// DELETE : supprimer une recette

router.delete("/:id", async (req, res) => {
  const id = parseInt(req.params.id);

  if (isNaN(id)) {
    return res.status(400).json({
      success: false,
      message: "ID incorrect",
      data : null
    });
  }

  try {
    const [result] = await mysqlConn.query(
      `DELETE FROM ${table} WHERE RC_Id = ?`,
      [id]
    );

    if (result.affectedRows === 0) {
      return res.status(404).json({
        success: false,
        message: "Recette non trouvée",
      });
    }

    res.status(200).json({
      success: true,
      message: "Recette supprimée avec succès",
    });
  } catch (error) {
    res.status(500).json({ success: false, message: error });
  }
});

export default router;
