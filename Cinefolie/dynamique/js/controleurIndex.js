const madiv = document.querySelector(".containeur");
var datas = JSON.parse(News);
affichage = "";
for (var i = 0 ; i < datas.length; i++){
    affichage += `
        <div class="reviewfilm">
            <div class="image"><img src="medias/contenu/${datas[i].Image}" alt="${datas[i].TxtAlt}"></div>
            <h1>${datas[i].Titre}</h1>
            <p>${datas[i].DateParrution}</p>
            <a href="pages/${datas[i].LienPage}"><button href="pages/${datas[i].LienPage}">Détails</button></a>
        </div>`
}
madiv.innerHTML = affichage;