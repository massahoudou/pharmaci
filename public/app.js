let search = document.querySelector('.banner-search')
let button = document.getElementById('search')
let fermer = document.getElementById('fermer')
console.log(search , button)

button.addEventListener('click',function(e){
    e.preventDefault
    search.style.display ='flex'
})

fermer.addEventListener('click',(e) => {
e.preventDefault
search.style.display ='none'
})

