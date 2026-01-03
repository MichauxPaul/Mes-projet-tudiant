const madiv = document.querySelector("#containeur1");
var datas = JSON.parse(boutique);
function afficheBoutique(filtre){
    var affichage = "";
    if (filtre == ""){
        for (var i = 0 ; i < datas.length ; i++){
            affichage += `
            <div class="boutique">
                <div class="image"><img src='../medias/contenu/${datas[i].Image}' alt='${datas[i].TxtAlt}'></div>
                <h1>${datas[i].Titre}</h1>`
            
            for (var j=0;j<datas[i].Prix.length;j++){
                affichage+=`                <p>${datas[i].Prix[j]}</p> `
            }
            affichage+=`    
                <a href="#ouvreModale1"><button href="#ouvreModale1">Ajouter au panier</button></a>
                </div>
                <div id="ouvreModale1" class="modalDialog">
                    <div>
                        <a href="#close" title="Fermer" class="close">x</a>
                        <p class="rouge">L'article a été ajouté à votre panier</p>
                    </div>
                    <a href="#close" title="Close" class="close">x</a>
                </div>`
        }
    }
    else if (filtre == "T-shirts"){
        console.log('cc1')
        for (var i =  0 ; i < datas.length; i++){
            if (datas[i].Genre.includes("T-Shirt")){
                affichage += `
            <div class="boutique">
                <div class="image"><img src='../medias/contenu/${datas[i].Image}' alt='${datas[i].TxtAlt}'></div>
                <h1>${datas[i].Titre}</h1>`
            
            for (var j=0;j<datas[i].Prix.length;j++){
                affichage+=`                <p>${datas[i].Prix[j]}</p> `
            }
            affichage+=`    
                <a href="#ouvreModale1"><button href="#ouvreModale1">Ajouter au panier</button></a>
                </div>
                <div id="ouvreModale1" class="modalDialog">
                    <div>
                        <a href="#close" title="Fermer" class="close">x</a>
                        <p class="rouge">L'article a été ajouté à votre panier</p>
                    </div>
                    <a href="#close" title="Close" class="close">x</a>
                </div>`
            }
        }
    }
    else if (filtre == "Bonnet"){
        console.log('cc2')
        for (var i =  0 ; i < datas.length; i++){
            if (datas[i].Genre.includes("Bonnet")){
                affichage += `
            <div class="boutique">
                <div class="image"><img src='../medias/contenu/${datas[i].Image}' alt='${datas[i].TxtAlt}'></div>
                <h1>${datas[i].Titre}</h1>`
            
            for (var j=0;j<datas[i].Prix.length;j++){
                affichage+=`                <p>${datas[i].Prix[j]}</p> `
            }
            affichage+=`    
                <a href="#ouvreModale1"><button href="#ouvreModale1">Ajouter au panier</button></a>
                </div>
                <div id="ouvreModale1" class="modalDialog">
                    <div>
                        <a href="#close" title="Fermer" class="close">x</a>
                        <p class="rouge">L'article a été ajouté à votre panier</p>
                    </div>
                    <a href="#close" title="Close" class="close">x</a>
                </div>`
            }
        }
    }
    else if (filtre == "Poster"){
        console.log('cc3')
        for (var i =  0 ; i < datas.length; i++){
            if (datas[i].Genre.includes("Poster")){
                affichage += `
            <div class="boutique">
                <div class="image"><img src='../medias/contenu/${datas[i].Image}' alt='${datas[i].TxtAlt}'></div>
                <h1>${datas[i].Titre}</h1>`
            
            for (var j=0;j<datas[i].Prix.length;j++){
                affichage+=`                <p>${datas[i].Prix[j]}</p> `
            }
            affichage+=`    
                <a href="#ouvreModale1"><button href="#ouvreModale1">Ajouter au panier</button></a>
                </div>
                <div id="ouvreModale1" class="modalDialog">
                    <div>
                        <a href="#close" title="Fermer" class="close">x</a>
                        <p class="rouge">L'article a été ajouté à votre panier</p>
                    </div>
                    <a href="#close" title="Close" class="close">x</a>
                </div>`
            }
        }
    }
    else if (filtre == "Pins"){
        console.log('cc4')
        for (var i =  0 ; i < datas.length; i++){
            if (datas[i].Genre.includes("Pins")){
                affichage += `
            <div class="boutique">
                <div class="image"><img src='../medias/contenu/${datas[i].Image}' alt='${datas[i].TxtAlt}'></div>
                <h1>${datas[i].Titre}</h1>`
            
            for (var j=0;j<datas[i].Prix.length;j++){
                affichage+=`                <p>${datas[i].Prix[j]}</p> `
            }
            affichage+=`    
                <a href="#ouvreModale1"><button href="#ouvreModale1">Ajouter au panier</button></a>
                </div>
                <div id="ouvreModale1" class="modalDialog">
                    <div>
                        <a href="#close" title="Fermer" class="close">x</a>
                        <p class="rouge">L'article a été ajouté à votre panier</p>
                    </div>
                    <a href="#close" title="Close" class="close">x</a>
                </div>`
            }
        }
    }
    else if (filtre == "Tout"){
        for (var i = 0 ; i < datas.length ; i++){
            affichage += `
            <div class="boutique">
                <div class="image"><img src='../medias/contenu/${datas[i].Image}' alt='${datas[i].TxtAlt}'></div>
                <h1>${datas[i].Titre}</h1>`
            
            for (var j=0;j<datas[i].Prix.length;j++){
                affichage+=`                <p>${datas[i].Prix[j]}</p> `
            }
            affichage+=`    
                <a href="#ouvreModale1"><button href="#ouvreModale1">Ajouter au panier</button></a>
                </div>
                <div id="ouvreModale1" class="modalDialog">
                    <div>
                        <a href="#close" title="Fermer" class="close">x</a>
                        <p class="rouge">L'article a été ajouté à votre panier</p>
                    </div>
                    <a href="#close" title="Close" class="close">x</a>
                </div>`
        }
    }
    madiv.innerHTML = affichage;
}
