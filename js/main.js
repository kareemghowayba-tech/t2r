document.addEventListener("DOMContentLoaded", () => {
    let turnoffBtn = document.querySelector(".turnoff");

    if (turnoffBtn) {
        turnoffBtn.addEventListener("click", (e) => {
            e.preventDefault();
            document.body.classList.toggle("paused");
            
            if (document.body.classList.contains("paused")) {
                turnoffBtn.textContent = "تشغيل الأنميشن";
            } else {
                turnoffBtn.textContent = "أوقف الأنميشن";
            }
        });
    }
});