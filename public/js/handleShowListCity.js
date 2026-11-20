const getCity = document.querySelector('.list-city')
const cityGr = document.querySelector('.city-gr')

function handleShowListCity() {
    cityGr.classList.remove('invi')
}

function handleCloseListCity() {
    cityGr.classList.add('invi')
}

getCity.onclick = function() {
    if(cityGr.classList[1] === "invi") {
        handleShowListCity()
    } else {
        handleCloseListCity()
    }
}