document.addEventListener("DOMContentLoaded",function(){
    const inputPassWord = document.querySelector('input[name="newpassword"]');
    const inputRePassWord = document.querySelector('input[name="enternewpassword"]');

    inputRePassWord.addEventListener('keyup',()=>{
        if(inputRePassWord.value.localeCompare(inputPassWord.value) == 0 ){

            inputRePassWord.classList.remove('wrong');
            inputRePassWord.classList.add('right');
        }
        else{ 
            inputRePassWord.classList.remove('right');
            inputRePassWord.classList.add('wrong');
        }
    })

})