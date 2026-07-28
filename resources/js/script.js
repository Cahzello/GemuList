/*==================================================
MY GAMES APP
Version 1.1
==================================================*/

const app = {

    games: [],

    filters: {

        Planning: true,

        "On Progress": true,

        Finished: true,

        Dropped: true

    },

    sort: "A-Z",

    search: ""

};

/*==================================================
DOM
==================================================*/

const DOM = {

    leftSection: document.querySelector(".main-section-left"),

    applyBtn: document.querySelector(".card-aside-right-col-btn"),

    sortAZ: document.querySelector(".btn2"),

    sortZA: document.querySelector(".btn3")

};

/*==================================================
LOAD GAME
==================================================*/
function loadGames(){

    app.games = [];

    const cards = document.querySelectorAll(".card-game");

    cards.forEach((card,index)=>{

        const title = card.querySelector(".card-game-text").textContent.trim();

        const status = card.querySelector(".btn-label1").textContent.trim();

        app.games.push({

            id:index+1,

            title,

            status,

            element:card

        });

    });

}

function printGames(){

    console.clear();

    console.table(app.games);

}

function createSearch(){

    const p=document.querySelector(

        ".card-aside-right-col-text-find-a-game"

    );

    const input=document.createElement("input");

    input.type="text";

    input.id="search";

    input.placeholder="Find a game...";

    input.style.width="100%";

    input.style.background="transparent";

    input.style.color="white";

    input.style.border="none";

    input.style.outline="none";

    input.style.fontSize="14px";

    p.replaceWith(input);

}

/*==================================================
FILTER GAMES (status + search)
==================================================*/

function applyFilters(){

    const searchKeyword = app.search.toLowerCase();

    app.games.forEach(game=>{

        const statusEnabled = app.filters[game.status] !== false;

        const searchMatch = !searchKeyword || game.title.toLowerCase().includes(searchKeyword);

        if(statusEnabled && searchMatch){

            game.element.style.display="flex";

        }else{

            game.element.style.display="none";

        }

    });

}

/*==================================================
SEARCH GAME
==================================================*/

function searchGames(keyword){

    app.search = keyword;

    applyFilters();

}

/*==================================================
INIT FILTERS (checkbox toggles)
==================================================*/

function initFilters(){

    const filterLabels = document.querySelectorAll(".card-aside-right-col-container5 .label");

    filterLabels.forEach(label=>{

        const status = label.getAttribute("data-status");

        if(!status) return;

        const checkbox = label.querySelector(".container");

        checkbox.classList.add("filter-checkbox");

        label.addEventListener("click",(e)=>{

            e.stopPropagation();

            app.filters[status] = !app.filters[status];

            if(app.filters[status]){

                checkbox.classList.remove("inactive");

                checkbox.classList.add("active");

            }else{

                checkbox.classList.remove("active");

                checkbox.classList.add("inactive");

            }

        });

    });

}

/*==================================================
SORT A-Z
==================================================*/

function sortAZ(){

    app.games.sort((a,b)=>{

        return a.title.localeCompare(b.title);

    });

    renderGames();

    applyFilters();

}

/*==================================================
SORT Z-A
==================================================*/

function sortZA(){

    app.games.sort((a,b)=>{

        return b.title.localeCompare(a.title);

    });

    renderGames();

    applyFilters();

}

/*==================================================
RENDER GAME
==================================================*/

function renderGames(){

    app.games.forEach(game=>{

        DOM.leftSection.appendChild(game.element);

    });

}

/*==================================================
SAVE STATUS
==================================================*/

function saveData(){

    const data = app.games.map(game=>{

        return{

            id:game.id,

            title:game.title,

            status:game.status

        };

    });

    localStorage.setItem(

        "mygames",

        JSON.stringify(data)

    );

}

/*==================================================
LOAD STATUS
==================================================*/

function loadData(){

    const raw = localStorage.getItem("mygames");

    if(!raw) return;

    const data = JSON.parse(raw);

    data.forEach(saved=>{

        const game = app.games.find(g=>g.id===saved.id);

        if(game){

            game.status = saved.status;

            const label = game.element.querySelector(".btn-label1");

            label.textContent = saved.status;
            game.element.querySelector('.btn').setAttribute('data-status', saved.status);

        }

    });

}

/*==================================================
REGISTER EVENTS
==================================================*/

function registerEvents(){

    const input=document.getElementById("search");

    input.addEventListener("keyup",(e)=>{

        searchGames(e.target.value);

    });

    DOM.sortAZ.addEventListener("click",()=>{

        sortAZ();

    });

    DOM.sortZA.addEventListener("click",()=>{

        sortZA();

    });

    DOM.applyBtn.addEventListener("click",()=>{

        applyFilters();

    });

    app.games.forEach(game=>{

        const btn = game.element.querySelector(".btn");

        btn.addEventListener("click",(e)=>{

            e.stopPropagation();

            createStatusMenu(btn, game);

        });

    });

    initFilters();

}

/*==================================================
STATUS MENU
==================================================*/

const STATUS = [
    "Planning",
    "On Progress",
    "Finished",
    "Dropped"
];

function createStatusMenu(button, game){

    const oldMenu = document.querySelector(".status-menu");

    if(oldMenu){
        oldMenu.remove();
    }

    const menu = document.createElement("div");

    menu.className = "status-menu";

    STATUS.forEach(status=>{

        const item = document.createElement("div");

        item.className = "status-item";

        item.setAttribute("data-status", status);

        item.textContent = status;

        item.addEventListener("click",()=>{

            game.status = status;

            button.querySelector(".btn-label1").textContent = status;
            button.setAttribute('data-status', status);

            saveData();

            menu.remove();

        });

        menu.appendChild(item);

    });

    document.body.appendChild(menu);

    const rect = button.getBoundingClientRect();

    menu.style.position="fixed";

    menu.style.left = rect.left + "px";

    menu.style.top = (rect.bottom + 5) + "px";

}

document.addEventListener("click", () => {

    const menu = document.querySelector(".status-menu");

    if(menu){

        menu.remove();

    }

});

document.addEventListener("DOMContentLoaded", init);

function init(){

    loadGames();

    createSearch();

    loadData();

    printGames();

    registerEvents();

}