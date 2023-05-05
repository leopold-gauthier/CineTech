// SCRIPT POUR AFFICHER LE TEXTAREA ET L'AUTRE POUR AUTO RESIZE LE TEXTAREA 

    var monAncre = document.querySelectorAll(".monAncre");
    var maDiv = document.querySelectorAll(".maDiv");

    monAncre.forEach((ancre, index) => {
        ancre.addEventListener("click", function(event) {
            event.preventDefault();

            // Cache toutes les divs sauf celle à l'index correspondant à l'ancre cliquée
            maDiv.forEach((div, i) => {
                if (i === index) {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            });
        });
    });



    var textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);

    function autosize() {
        var el = this;
        setTimeout(function() {
            el.style.cssText = 'height:auto; padding:0';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        }, 0);
    }
