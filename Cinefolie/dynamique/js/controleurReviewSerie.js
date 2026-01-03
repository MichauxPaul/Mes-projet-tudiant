const madiv2 = document.querySelector("#container2");
var datas2 = JSON.parse(ReviewSeries);
let affichage2 = "";
for (var i = 0 ; i < datas2.length; i++){
    affichage2 += `
        <div class="reviewfilm">
            <div class="image"><img src="../medias/contenu/${datas2[i].Image}" alt="${datas2[i].TxtAlt}"></div>
            <h1>${datas2[i].Titre}</h1>
            <a href="${datas2[i].LienPage}"><button href="${datas2[i].LienPage}">Détails</button></a>
        </div>`
}
madiv2.innerHTML = affichage2;