function killFlag() {
    let iframe = document.getElementById("flag_content");
    iframe.style.transition = "2s";
    iframe.style.opacity = "0";

    setTimeout(hideFlag,3000);

    function hideFlag() {
        iframe.setAttribute("display","none");
        console.log("flag is removed");
    }
}