const header = document.querySelector('header')

window.addEventListener('scroll',()=>{
  const trigger = 90
  const top = Math.min(Math.floor(window.scrollY-trigger-header.clientHeight),0)
  header.setAttribute('style',`--_top:${top}px`)
  header.classList.toggle('active',window.scrollY > trigger)
})
