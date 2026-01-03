/**
 * @description Ce module `fetcher` fournit un ensemble de méthodes asynchrones (GET, POST, PUT, DELETE) 
 *              pour interagir avec une API en utilisant l’interface Fetch. Chaque méthode permet d'envoyer 
 *              des requêtes HTTP et de gérer les réponses JSON de manière standardisée, tout en capturant 
 *              les erreurs éventuelles.
 * 
 * @example
 * // Exemple d'utilisation avec la méthode GET pour récupérer des données X
 * async function getUsers() {
 *   
 *   const response = await fetcher.get('users');
 *   if (response.success) {
 *     console.log('Liste des utilisateurs :', response.data);
 *   } else {
 *     console.error('Erreur :', response.message);
 *   }
 * }
 * 
 * getUsers();
 */



const host = "http://127.0.0.1:3005";

const fetcher = {
  //fonction pour récupérer (GET)
  async get(routeName) {
    try {
      const res = await fetch(`${host}/${routeName}`, {
        headers: {
          "Content-Type": "application/json",
        },
        method: "get",
      });

      if (res.ok) {
        const json = await res.json();
        return { success: json.success, message: json.message, data: json.data };
      } else {
        const json = await res.json();
        return { success: false, message: json.message, data: json.data };
      }
    } catch (error) {
      console.log(error);
      return { success: false, message: error };
    }
  },
  //fonction pour créer
  async post(routeName, payload) {
    try {
      const res = await fetch(`${host}/${routeName}`, {
        headers: {
          "Content-Type": "application/json",
        },
        method: "post",
        body: JSON.stringify(payload),
      });

      if (res.ok) {
        const json = await res.json();
        return { success: json.success, message: json.message, data: json.data };
      } else {
        const json = await res.json();
        return { success: false, message: json.message, data: json.data };
      }
    } catch (error) {
      console.error(error);
      return { success: false, message: error };
    }
  },

  //fonction pour modifier
  async put(routeName, payload) {
    try {
      const res = await fetch(`${host}/${routeName}`, {
        headers: {
          "Content-Type": "application/json",
        },
        method: "put",
        body: JSON.stringify(payload),
      });

      if (res.ok) {
        const json = await res.json();
        return { success: json.success, message: json.message, data: json.data };
      } else {
        const json = await res.json();
        return { success: false, message: json.message, data: json.data };
      }
    } catch (error) {
      console.error(error);
      return { success: false, message: error };
    }
  },

  //fonction pour effacer
  async delete(routeName) {
    try {
      const res = await fetch(`${host}/${routeName}`, {
        headers: {
          "Content-Type": "application/json",
        },
        method: "delete",
      });

      if (res.ok) {
        const json = await res.json();
        return { success: json.success, message: json.message, data: json.data };
      } else {
        const json = await res.json();
        return { success: false, message: json.message, data: json.data };
      }
    } catch (error) {
      console.error(error);
      return { success: false, message: error };
    }
  },
};

export default fetcher;
