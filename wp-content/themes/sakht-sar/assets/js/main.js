document.addEventListener('DOMContentLoaded',()=>{
  const hero=document.querySelector('.hero');
  if(hero){
    const move=e=>{if(window.innerWidth<900)return;const x=(e.clientX/window.innerWidth-.5)*8;const y=(e.clientY/window.innerHeight-.5)*4;hero.style.backgroundPosition=`calc(50% + ${x}px) calc(50% + ${y}px)`};
    window.addEventListener('mousemove',move,{passive:true});
  }
  document.querySelectorAll('.hero-search').forEach(form=>form.addEventListener('submit',()=>{const input=form.querySelector('input');if(input && !input.value.trim()){input.focus();}}));
  document.querySelectorAll('.carousel-btn').forEach(btn=>btn.addEventListener('click',()=>{const grid=btn.closest('.places-wrap')?.querySelector('.places-grid');if(grid)grid.scrollBy({left:btn.classList.contains('left')?-300:300,behavior:'smooth'});}));
});
