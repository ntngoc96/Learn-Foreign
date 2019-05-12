document.addEventListener("DOMContentLoaded",function(){
    var ListAnswers = document.querySelectorAll('.answers');
    var FormSubmit  = document.querySelector('.form-quiz');
    var resultAnswer = document.querySelector('.result');
    const btnClose = document.querySelector('.btn-close');
    const Popup = document.querySelector('.popup');
    var typeSelection = document.getElementById('type');
    const listWordId = document.querySelectorAll('input[type=hidden]');
    const sectionQuiz = document.querySelector('.section-quiz');
    const Score = document.querySelector('.score');

    function getStringWordId(){
        let str = "";
        let i = 0;
        listWordId.forEach(wordid => {
            str = str.concat('id',i++,'=',wordid.value,'&');
        });
        return str.substr(0,str.length-1);
    }
    typeSelection.addEventListener('change',function (){
        //remove old value;
        FormSubmit.remove('.form-quiz');
        
        let url = `index.php?controller=words&action=getQuestion&type=${typeSelection.value}&`;
        url = url.concat(getStringWordId());
        getDetail(url,showDetail);
    })

    function getDetail(url,callback){
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                callback(this);
            }
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send();
    }
    function showDetail(xmlhttp){
        sectionQuiz.innerHTML = xmlhttp.responseText;

        //after render. assign variable again
        ListAnswers = document.querySelectorAll('.answers');
        FormSubmit  = document.querySelector('.form-quiz');
        resultAnswer = document.querySelector('.result');

        //the same thing with listener
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
                }
                else if(temp.value == "true"){
                    sumRightQuestion++;
                    temp.parentElement.classList.add('green');
                }
            }
    
            resultAnswer.innerHTML = `Right answer: ${sumRightQuestion}/${sumQuestion}`;
            Score.innerHTML = `${sumRightQuestion*100}`;
            Popup.style.top = "50%";
            Popup.style.transform = "translate(-50%,-50%)";
        });
    }

    FormSubmit.addEventListener('submit',function displayResult(event){
        event.preventDefault();
        let point = 0;
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
            }
            else if(temp.value == "true"){
                sumRightQuestion++;
                temp.parentElement.classList.add('green');
            }
        }

        resultAnswer.innerHTML = `Right answer: ${sumRightQuestion}/${sumQuestion}`;
        Score.innerHTML = `${sumRightQuestion*100}`;
        Popup.style.top = "50%";
        Popup.style.transform = "translate(-50%,-50%)";
    });

    btnClose.addEventListener('click',function(){
        Popup.style.top = "100%";
        Popup.style.transform = "translate(-50%,0)";
    })
    
})