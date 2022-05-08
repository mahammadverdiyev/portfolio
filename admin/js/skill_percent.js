$(document).ready(function(){
    document.querySelector("#skills").addEventListener("change", function(e){

        if(e.target.id.startsWith("range")){
            let cur= e.target;
            document.querySelector("."+cur.id).textContent=cur.value;
        }

        if(e.target.tagName === 'SELECT'){
            console.log(e.target.value);
        }

    })
});