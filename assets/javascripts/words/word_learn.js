document.addEventListener('DOMContentLoaded', function(){
    var leftArrow = document.querySelectorAll('.left');
    var rightArrow = document.querySelectorAll('.right');
    var wrapper = document.querySelectorAll('.wrapper');
   
    // console.log(leftArrow,'right',rightArrow,'wrapper',wrapper);
    for(x of rightArrow){
        x.addEventListener('click',()=>{
            var currentWrapper = document.querySelector('.wrapper.actived');
            if(currentWrapper.nextElementSibling.className == 'wrapper'){
                currentWrapper.classList.add('animation-left');
                setTimeout(()=>{
                    currentWrapper.classList.remove('actived');
                    currentWrapper.classList.remove('animation-left');
                    currentWrapper = currentWrapper.nextElementSibling;
                    currentWrapper.classList.add('actived');
                },1000);
            } else {
                wrapper[wrapper.length-1].classList.add('animation-left');
                setTimeout(() => {
                    wrapper[wrapper.length-1].classList.remove('actived');
                    wrapper[wrapper.length-1].classList.remove('animation-left');
                    currentWrapper = wrapper[0];
                    currentWrapper.classList.add('actived');
                    console.log('add');
                }, 1000);
                
            }

        })
    }

    for(x of leftArrow){
        x.addEventListener('click',()=>{
            var currentWrapper = document.querySelector('.wrapper.actived');
            if(currentWrapper.previousElementSibling){
                currentWrapper.classList.add('animation-right')
                setTimeout(()=>{
                    currentWrapper.classList.remove('actived');
                    currentWrapper.classList.remove('animation-right');
                    currentWrapper = currentWrapper.previousElementSibling;
                    currentWrapper.classList.add('actived');
                },1000);
            } else {
                wrapper[0].classList.add('animation-right');
                setTimeout(() => {
                    wrapper[0].classList.remove('actived');
                    wrapper[0].classList.remove('animation-right');
                    currentWrapper = wrapper[wrapper.length-1];
                    currentWrapper.classList.add('actived');
                }, 1000);
            }
        })
    }
});