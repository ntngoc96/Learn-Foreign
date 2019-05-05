document.addEventListener("DOMContentLoaded",function(){
    const btnMakeTest = document.getElementById('btn--make-test');
    const btnStartLearn = document.getElementById('btn--start-learn');
    const ListDetail = document.querySelectorAll('#get-detail-ajax');
    const Popup = document.getElementById('popup');
    
    
    
    btnMakeTest.addEventListener('click',()=>{
        document.getElementById("form__post-test").action = "index.php?controller=words&action=makeTest";
    });
    
    btnStartLearn.addEventListener('click',()=>{
        document.getElementById("form__post-test").action = "index.php?controller=words&action=learn";
    }); 

    for( detail of ListDetail){
        
        detail.addEventListener('click', function(){
            console.log(this.getAttribute('data'))
            getDetail('index.php?controller=words&action=getDetail&id='+this.getAttribute('data'),showDetail);
        })
    }
    
    function getDetail(url,callback){
        var xmlhttp = new XMLHttpRequest();
        console.log(url);
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                callback(this);
            }
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send();
    }
    function showDetail(xmlhttp){
        Popup.innerHTML = xmlhttp.responseText;
        let btnClose = document.querySelector('.btn--close');
        let PopupDetail = document.querySelector('.popup__word-detail')
        btnClose.addEventListener('click',()=>{
            console.log('oke')
            PopupDetail.remove('.popup__word-detail');
            })
    }
})