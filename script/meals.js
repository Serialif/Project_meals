(function () {
        let textArea = document.getElementsByClassName('text-area');
        let logIn = document.getElementById('logIn');
        let saveAll = document.getElementById('saveAll');
        let delAll = document.getElementById('delAll');
        let home = document.getElementById('home');
        let save = document.getElementById('save')
        let showHelp = document.getElementById('showHelp');
        let help = document.getElementById('help');
        let day = document.getElementsByClassName('day');
        let dayOfThWeek = new Date().getDay();
        let borderRed = "2px dashed rgba(221,110,84,1)";
        let borderGreen = "4px groove rgba(172,218,49,1)";
        let colorGreen = "rgba(172,218,49,0.5)"
        let colorOrange = "rgb(255, 120, 0)";

        for (let i = 0; i < day.length; i++) {
            if (i + 1 === dayOfThWeek) {
                day[i].firstElementChild.lastElementChild.firstElementChild.firstElementChild.
                    style.display = "inline";
                day[i].firstElementChild.lastElementChild.firstElementChild.firstElementChild.
                    nextElementSibling.style.fontWeight = "800";
                day[i].firstElementChild.firstElementChild.nextElementSibling.nextElementSibling.
                    firstElementChild.lastElementChild.style.display = "inline";
            }
        }

        for (let i = 0; i < textArea.length; i++) {
            textArea[i].style.background = "rgba(0,0,0,0)";
            if (textArea[i].value === '') {
                textArea[i].style.border = borderRed;
            } else {
                textArea[i].style.border = borderGreen;
                textArea[i].style.background = colorGreen;
                textArea[i].style.color = "black";
                textArea[i].style.fontWeight = "600";
            }
            let timeout;
            let lastTap = 0;
            textArea[i].addEventListener('touchend', function (e) {
                let currentTime = new Date().getTime();
                let tapLength = currentTime - lastTap;
                clearTimeout(timeout);
                if (tapLength < 500 && tapLength > 0) {
                    textArea[i].value = '';
                    textArea[i].style.border = borderRed;
                    e.preventDefault();
                    saveAll.click();
                }
                lastTap = currentTime;
            })
            textArea[i].addEventListener('dblclick', function (e) {
                textArea[i].value = '';
                textArea[i].style.border = borderRed;
                e.preventDefault();
                saveAll.click();
            })
            textArea[i].addEventListener('keyup', function () {
                if (textArea[i].value === '') {
                    textArea[i].style.border = borderRed;
                } else {
                    textArea[i].style.background = colorOrange;
                    textArea[i].style.color = "white";
                }
            })
            textArea[i].addEventListener('blur', function () {
            })
        }
        if (delAll !== null) {
            delAll.addEventListener('click', function () {
                let confirm = window.confirm('Voulez-vous vraiment tout supprimer ?')
                if (confirm === true) {
                    for (let i = 0; i < textArea.length; i++) {
                        textArea[i].value = '';
                        textArea[i].style.border = borderRed;
                        saveAll.click();
                    }
                }
            })
        }

        showHelp.addEventListener('click', function () {
            if (help.style.display !== 'block') {
                help.style.display = 'block';
            } else {
                help.style.display = 'none';
            }
        })

        if (save !== null) {
            save.addEventListener('click', function () {
                saveAll.click();
            })
        }


        if (logIn !== null) {
            logIn.addEventListener('click', function () {
                alert('Impossible de se connecter actuellement.');
            })
        }

        document.addEventListener('keydown', function (e) {
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                saveAll.click();
            } else if (e.ctrlKey && e.key === 'd') {
                e.preventDefault();
                delAll.click();
            } else if (e.ctrlKey && e.key === 'r') {
                e.preventDefault();
                home.click();
            } else if (e.ctrlKey && e.key === 'h') {
                e.preventDefault();
                showHelp.click();
            }
        });
    }
)
()