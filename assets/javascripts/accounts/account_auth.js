document.addEventListener("DOMContentLoaded",function(){
    const radioRegister = document.getElementById('nav__register');
    const radioLogin = document.getElementById('nav__login');
    const formRegister = document.querySelector('.card__size--front');
    const formLogin = document.querySelector('.card__size--back');
    const inputPassWord = document.querySelector('input[name="password"]');
    const inputRePassWord = document.querySelector('input[name="repassword"]');
    const idRegister = document.getElementById('account_id');
    const idLogin = document.getElementById('username');
    const navGroup = document.querySelectorAll('.nav__group');
    const AccountIdWarning = document.querySelector('.account_id-warning');
    const RePasswordWarning = document.querySelector('.repassword-warning');


    radioRegister.addEventListener('change',()=>{
        formLogin.classList.remove('actived');
        navGroup[1].classList.remove('actived-border-bottom');
        formRegister.classList.add('actived');
        navGroup[0].classList.add('actived-border-bottom');

    });

    radioLogin.addEventListener('change',()=>{
        formRegister.classList.remove('actived');
        navGroup[0].classList.remove('actived-border-bottom');
        formLogin.classList.add('actived');
        navGroup[1].classList.add('actived-border-bottom');
        
    });

    inputRePassWord.addEventListener('keyup',()=>{
        if(inputRePassWord.value.localeCompare(inputPassWord.value) == 0 ){

            inputRePassWord.classList.remove('wrong');
            inputRePassWord.classList.add('right');

            RePasswordWarning.innerHTML = "&nbsp;";
        }
        else{ 
            inputRePassWord.classList.remove('right');
            inputRePassWord.classList.add('wrong');

            RePasswordWarning.innerHTML = "&nbsp;Re-password doesn't match";
        }
    });

    inputPassWord.addEventListener('keyup',()=>{
        if(inputRePassWord.value.localeCompare(inputPassWord.value) == 0 ){

            inputRePassWord.classList.remove('wrong');
            inputRePassWord.classList.add('right');

            RePasswordWarning.innerHTML = "&nbsp;";
        }
        else{ 
            inputRePassWord.classList.remove('right');
            inputRePassWord.classList.add('wrong');

            RePasswordWarning.innerHTML = "&nbsp;Re-password doesn't match";
        }
    })

    idRegister.addEventListener('keyup',()=>{
        if(idRegister.value.length < 6){
            AccountIdWarning.innerHTML = "&nbsp;Username can't be less than 6";
        }
        else{
            AccountIdWarning.innerHTML = "&nbsp;";
        }
    })

})