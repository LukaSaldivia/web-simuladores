const url = document.querySelector('#url')
const img = document.querySelector('#miniatura')

if (url) {
  url.addEventListener('input',()=>{
    const id = url.value.split('=')[1].split('&')[0];
    img.src = `http://img.youtube.com/vi/${id}/hqdefault.jpg`
  
  })
  
}

const castSelect = document.querySelector('#cast')
const castHidden = document.querySelector('#castHidden')
const castResults = document.querySelector('.cast-results')




let castList = {}
let castIdSelected = []

castSelect.querySelectorAll('option').forEach(option => {
  castList[option.value] = option.text
})


if (castHidden.value.length > 0) {
    let str = ''  
    castHidden.value.split('/').forEach(id => {
      if (castList[id]) {
        str += `<div>${castList[id]}</div>`
      }
    })
    castResults.innerHTML = str  
  }


castSelect.addEventListener('input',()=>{
  castIdSelected.push(castSelect.value)
  castIdSelected = [...new Set(castIdSelected)]
  let innerValue = castIdSelected.join('/')
  castHidden.value = innerValue

  let str = ''

    
    castIdSelected.forEach(id => {
      if (castList[id]) {
        str += `<div>${castList[id]}</div>`
      }
    })

  castResults.innerHTML = str
})