let elments = {
    main: document.getElementsByClassName("main")[0] ,
    hideeditor : document.getElementById("hide"),
    changedirbtn : document.getElementById("changeDir"),
    iframe : document.getElementById("iframe"),
    textarea : document.getElementById("editor"),
    runbtn : document.getElementById("runBtn") ,
}
let ischange = false
let ischange2 = false
elments.hideeditor.addEventListener("click" , _ => {
    ischange = !ischange
    elments.hideeditor.innerHTML = ischange ? "اظهر المحرر" : "اخفي المحرر"
    elments.textarea.style.display = ischange ? "none" : "block"
    elments.main.style.gridTemplateRows = ischange ? "2fr  auto 1fr" : "1fr 1fr auto 1fr"

})
elments.changedirbtn.addEventListener("click" , _ => {
    ischange2 = !ischange2
    elments.changedirbtn.innerHTML = ischange2 ?   "اكتب بالانجليزيه" : "اكتب بالعربيه" 
    elments.textarea.dir = ischange2? "rtl" : "ltr"
})
elments.runbtn.addEventListener("click" , _ => {
    elments.iframe.srcdoc = elments.textarea.value
})