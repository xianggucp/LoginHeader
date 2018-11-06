function login(){
 var user = document.cookie;
 var arr = user.split(";");
 var info = arr[0].split("=");
 var divobj = document.getElementsByTagName('div')
 // ["user=admin", " word=123"]
 var login = divobj[0];
 var mask = divobj[1];
 var liobj = divobj[1].children[0].children;
 liobj[1].innerHTML = "<a href='#'>"+info[1]+"</a>";
 if(user){
 	login.style.display = "none";
 	mask.style.display = "block";
 }else{
 	login.style.display = "block";
 	mask.style.display = "none";
 }
}