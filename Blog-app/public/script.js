var deleteBtn=document.querySelectorAll(".delete");
deleteBtn.forEach(element => {
    element.addEventListener("click",(event)=>{
     var  postId= event.target.getAttribute("data-id");
     var form =document.getElementById("form");
     form.setAttribute('action',`/posts/${postId}`)
    })
});


