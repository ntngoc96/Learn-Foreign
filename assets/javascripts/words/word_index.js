document.addEventListener("DOMContentLoaded",function(){
    const btnMakeTest = document.getElementById('btn--make-test');
    const btnStartLearn = document.getElementById('btn--start-learn');
    // const formPostTest = document.getElementById('form__post-test');
    
    btnMakeTest.addEventListener('click',()=>{
        document.getElementById("form__post-test").action = "index.php?controller=words&action=makeTest";
    });

    btnStartLearn.addEventListener('click',()=>{
        document.getElementById("form__post-test").action = "index.php?controller=words&action=learn";
    });
})