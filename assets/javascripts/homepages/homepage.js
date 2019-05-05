document.addEventListener('DOMContentLoaded',function(){
    const dot = document.querySelectorAll('.dot');
    const slide = document.querySelectorAll('.slide');
    const leftArrow = document.getElementById('left');
    const rightArrow = document.getElementById('right');
    console.log(dot,slide,leftArrow);

    for( x of dot){
        
        x.addEventListener('click', function(){
            var number = 0;
            var current = this;
            for(x of dot) x.classList.remove('actived');
            current.classList.add('actived');
            for(x of slide) x.classList.remove('actived');

            //loop to find position of slide current
            while(current = current.previousElementSibling) number++;
            slide[number].classList.add('actived');
        })
    }

    //move previous slide when user click left arrow
    leftArrow.addEventListener('click',()=>{
        var currentDot= document.querySelector('.dot.actived');
        var currentSlideImage = document.querySelector('.slide.actived');

        //remove class actived before changing
        currentDot.classList.remove('actived');
        currentSlideImage.classList.remove('actived');

        if(currentDot.previousElementSibling){
            currentDot.previousElementSibling.classList.add('actived');
            currentSlideImage.previousElementSibling.classList.add('actived');
        }
        else{
            let length = slide.length;
            slide[length-1].classList.add('actived');
            dot[length-1].classList.add('actived');
        }
        
    });

    //move to next slide when user click right arrow
    rightArrow.addEventListener('click',()=>{
        var currentDot= document.querySelector('.dot.actived');
        var currentSlideImage = document.querySelector('.slide.actived');

        currentDot.classList.remove('actived');
        currentSlideImage.classList.remove('actived');

        if(currentDot.nextElementSibling){
            currentDot.nextElementSibling.classList.add('actived');
            currentSlideImage.nextElementSibling.classList.add('actived');
        }
        else{
            slide[0].classList.add('actived');
            dot[0].classList.add('actived');
        }
        
    });

    function nextSlide(){
        var currentSlideImage = document.querySelector('.slide.actived');
        var currentDot        = document.querySelector('.dot.actived');

        for(x of slide) x.classList.remove('actived');
        for(x of dot) x.classList.remove('actived');

        //check whether it's the last element or not
        if(currentSlideImage.nextElementSibling){
            currentSlideImage.nextElementSibling.classList.add('actived');
            currentDot.nextElementSibling.classList.add('actived');
        }
        else{
            slide[0].classList.add('actived');
            dot[0].classList.add('actived');
        }

    };

    setInterval(nextSlide,3000);

})