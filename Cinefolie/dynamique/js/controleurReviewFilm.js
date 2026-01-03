const madiv1 = document.querySelector("#container1");
var datas1 = JSON.parse(ReviewFilm);
let affichage1 = "";
for (var i = 0 ; i < datas1.length; i++){
    affichage1 += `
        <div class="reviewfilm">
            <div class="image"><img src="../medias/contenu/${datas1[i].Image}" alt="${datas1[i].TxtAlt}"></div>
            <h1>${datas1[i].Titre}</h1>
            <a href="${datas1[i].LienPage}"><button href="${datas1[i].LienPage}">Détails</button></a>
        </div>`
}
madiv1.innerHTML = affichage1;