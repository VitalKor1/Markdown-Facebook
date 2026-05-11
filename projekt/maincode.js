document.addEventListener("click", function (e) {
    if (e.target.classList.contains("deletebutton")) {

        const card = e.target.closest(".card");
        const id = card?.getAttribute("data-id");

        if (!id) {
            alert("Missing post ID");
            return;
        }

        fetch("delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + encodeURIComponent(id)
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "OK") {
                card.remove();
            } else {
                console.log(data);
                alert("Error deleting post");
            }
        });
    }
});

const createbutton = document.querySelector(".crtpst");

createbutton.addEventListener('click', function(){
    window.location.href = "addPost.php";
});

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("morinfo")) {
        const card = e.target.closest(".card");
        
        const text = card.querySelector(".card-info p").innerText;
        const imgTag = card.querySelector("img:not(.logoface)"); 
        const imgSrc = imgTag ? imgTag.getAttribute("src") : "";


        const url = `moreInfo.php?text=${encodeURIComponent(text)}&img=${encodeURIComponent(imgSrc)}`;
        window.location.href = url;
    }
});

const logoname = document.querySelector(".LogoName");

logoname.addEventListener('click', function(){
    window.location.href = "";
})

document.addEventListener('DOMContentLoaded', () => {
    const creatorLogo = document.querySelector('.creatorlogo');
    const settingsWindow = document.querySelector('.settingswindow');

    if (creatorLogo && settingsWindow) {
        creatorLogo.addEventListener('click', (event) => {

            if (settingsWindow.style.display === 'block') {
                settingsWindow.style.display = 'none';
            } else {
                settingsWindow.style.display = 'flex';
            }
            
            event.stopPropagation();
        });


        document.addEventListener('click', (event) => {
            if (!settingsWindow.contains(event.target) && event.target !== creatorLogo) {
                settingsWindow.style.display = 'none';
            }
        });
    }
});

const btnregist = document.querySelector(".btnregist");

btnregist.addEventListener('click', (event) => {
    window.location.href = "rejestracja.php";
})



const btnlogin = document.querySelector(".btnlogin");

btnlogin.addEventListener('click', (event) => {
    window.location.href = "login.php";
})