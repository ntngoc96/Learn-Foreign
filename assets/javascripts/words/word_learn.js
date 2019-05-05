document.addEventListener('DOMContentLoaded', function(){
    var leftArrow = document.querySelectorAll('.left');
    var rightArrow = document.querySelectorAll('.right');
    var wrapper = document.querySelectorAll('.wrapper');

    // console.log(leftArrow,'right',rightArrow,'wrapper',wrapper);
    for(x of rightArrow){
        x.addEventListener('click',()=>{
            var currentWrapper = document.querySelector('.wrapper.actived');
            if(currentWrapper.nextElementSibling){
                currentWrapper.classList.add('animation-left');
                setTimeout(()=>{
                    currentWrapper.classList.remove('actived');
                    currentWrapper.classList.remove('animation-left');
                    currentWrapper = currentWrapper.nextElementSibling;
                    currentWrapper.classList.add('actived');
                },1000);
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
            }
        })
    }
});