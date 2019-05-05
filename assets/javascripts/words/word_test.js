document.addEventListener("DOMContentLoaded",function(){
    const ListAnswers = document.querySelectorAll('.answers');
    const FormSubmit  = document.querySelector('.form-quiz');
    const resultAnswer = document.querySelector('.result');
    const btnClose = document.querySelector('.btn-close');
    const Popup = document.querySelector('.popup');
    console.log(ListAnswers)

    FormSubmit.addEventListener('submit',function displayResult(event){
        event.preventDefault();
        let sumQuestion = ListAnswers.length/4;

        for (let index = 0; index < ListAnswers.length; index++) {
            ListAnswers[index].classList.remove('red');
            ListAnswers[index].classList.remove('green');
        }
        
        let sumRightQuestion = 0;
        for(let i = 0; i< sumQuestion;i++){
            let temp = document.querySelector(`input[name="${i+1}"]:checked`);
            if(temp === null){
                for(let j = i*4,length = i*4+3;j<=length;j++){
                    ListAnswers[j].classList.add('red');
                }
            }else if(temp.value == "false"){
                temp.parentElement.classList.add('red');
                console.log('ưởng')
            }
            else if(temp.value == "true"){
                sumRightQuestion++;
                temp.parentElement.classList.add('green');
            }
        }

        resultAnswer.innerHTML = `Right answer: ${sumRightQuestion}/${sumQuestion}`;
        Popup.style.top = "50%";
        Popup.style.transform = "translate(-50%,-50%)";
    });

    btnClose.addEventListener('click',function(){
        Popup.style.top = "100%";
        Popup.style.transform = "translate(-50%,0)";
    })
    
})