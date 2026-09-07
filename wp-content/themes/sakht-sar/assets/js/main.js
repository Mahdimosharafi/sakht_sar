document.addEventListener('DOMContentLoaded',function(){
  const reduce=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const hero=document.querySelector('.hero');

  /* Hero slideshow: keeps the homepage alive without any dependency. */
  if(hero){
    const slides=[
      'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=2200&q=86',
      'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=2200&q=86',
      'https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?auto=format&fit=crop&w=2200&q=86'
    ];
    let index=0;
    const setSlide=function(next){
      index=(next+slides.length)%slides.length;
      hero.style.backgroundImage='url("'+slides[index]+'")';
    };
    const next=hero.querySelector('.hero-arrow-next');
    const prev=hero.querySelector('.hero-arrow-prev');
    if(next) next.addEventListener('click',function(){setSlide(index+1)});
    if(prev) prev.addEventListener('click',function(){setSlide(index-1)});
    if(!reduce){setInterval(function(){setSlide(index+1)},7000)}
    if(!reduce && window.matchMedia('(pointer: fine)').matches){
      window.addEventListener('mousemove',function(event){
        if(window.innerWidth<900)return;
        const x=(event.clientX/window.innerWidth-.5)*5;
        const y=(event.clientY/window.innerHeight-.5)*2.5;
        hero.style.backgroundPosition='calc(50% + '+x+'px) calc(50% + '+y+'px)';
      },{passive:true});
    }
  }

  /* Search: do not submit an empty query. */
  document.querySelectorAll('.hero-search').forEach(function(form){
    form.addEventListener('submit',function(event){
      const input=form.querySelector('input[name="s"]');
      if(input && !input.value.trim()){event.preventDefault();input.focus();}
    });
  });

  /* Horizontal places carousel. */
  document.querySelectorAll('.carousel-btn').forEach(function(button){
    button.addEventListener('click',function(){
      const grid=button.closest('.places-wrap')?.querySelector('.places-grid');
      if(!grid)return;
      const amount=Math.max(280,Math.round(grid.clientWidth*.72));
      const direction=button.classList.contains('carousel-btn-left')?1:-1;
      grid.scrollBy({left:direction*amount,behavior:'smooth'});
    });
  });

  /* Reveal cards as the visitor scrolls. */
  if('IntersectionObserver' in window && !reduce){
    const style=document.createElement('style');
    style.textContent='.ss-reveal{opacity:0;transform:translateY(16px);transition:opacity .55s ease,transform .55s ease}.ss-reveal-visible{opacity:1;transform:none}';
    document.head.appendChild(style);
    const items=document.querySelectorAll('.service-card,.place-card,.trip-card,.panel,.video-banner');
    const observer=new IntersectionObserver(function(entries,obs){
      entries.forEach(function(entry){
        if(!entry.isIntersecting)return;
        entry.target.classList.add('ss-reveal-visible');
        obs.unobserve(entry.target);
      });
    },{threshold:.08,rootMargin:'0px 0px -25px'});
    items.forEach(function(item){item.classList.add('ss-reveal');observer.observe(item)});
  }
});
