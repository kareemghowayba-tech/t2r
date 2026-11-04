const elmemnts = {
    editlessonalert: document.getElementById("editlessonalert"),
    addlessonalert: document.getElementById("addlessonalert"),
    editbtns : document.querySelectorAll(".editbtn"),
    addLessonbtn:document.getElementById("addLessonbtn"),
    exitbtns: document.querySelectorAll('.exit'),
    hiddeninput: document.querySelectorAll(".hidden"),
    hiddenedit: document.querySelectorAll(".hiddenedit"),
} ;

elmemnts.editbtns.forEach(btn => {
    btn.addEventListener("click", _ => {
    elmemnts.editlessonalert.showModal()
        
})
});
elmemnts.exitbtns.forEach(btn => {
    btn.addEventListener("click", e => {
    e.preventDefault();
    elmemnts.addlessonalert.close();
    elmemnts.editlessonalert.close();
})})

elmemnts.addLessonbtn.addEventListener("click", _ => {
    elmemnts.addlessonalert.showModal()
} )