
let toggle = false;

document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        document.getElementById("inputFile").addEventListener("change", selectFiles);
        document.getElementById("send").addEventListener("click", onclick);
    }
}

function selectFiles(e) {
    const files = document.getElementById("inputFile").files;
    let div = document.getElementById("select");
    
    // clear select area
    while (div.hasChildNodes()) {
        div.removeChild(div.children[0]);
    }

    Array.from(files).forEach(file => {
        const item = document.createElement("span");
        item.className = "badge badge-info";
        item.innerHTML = file.name;
        div.appendChild(item);
    });
}

function toggleSpinner() {
    let spinner = document.getElementById("spinner");
    if (toggle) {
        spinner.style.display = 'none';
    } else {
        spinner.style.display = 'block'
    }
    toggle = !toggle;
}

function onclick() {
    toggleSpinner();
    const files = document.getElementById("inputFile").files;
    const to = document.getElementById("inputEmail").value;
    const from = document.getElementById("inputFrom").value;
    const subject = document.getElementById("inputSubject").value;
    const text = document.getElementById("inputText").value;
    const allowHtml = document.getElementById("allowhtml").checked;

    var data = new FormData();
    data.append("to", to);
    data.append("from", from);
    data.append("subject", subject);
    data.append("text", text);

    if(allowHtml) {
        data.append("html", true);
    }

    Array.from(files).forEach(file => {
        data.append("files[]", file);
    });

    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
            console.log(this.responseText);
            toggleSpinner();
        }
    });

    xhr.open("POST", "http://localhost/sendmail.php");

    xhr.send(data);
}
