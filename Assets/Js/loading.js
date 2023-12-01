window.addEventListener('load', () =>{
    const loading = document.querySelector('.loading');

    loading.classList.add('visually-hidden');

    loading.addEventListener('transitioned', ()  => {
        document.body.removeChild('loading');
    })
    
})