const header = document.querySelector('header')
const scrollWatcher = document.createElement('div')

scrollWatcher.setAttribute('data-scroll-watcher','')
header.before(scrollWatcher)

const headerObserver = new IntersectionObserver((entries)=>{
  header.classList.toggle('active',!entries[0].isIntersecting)
})

headerObserver.observe(scrollWatcher)
