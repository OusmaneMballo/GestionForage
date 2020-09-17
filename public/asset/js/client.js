
function addClient() {
    let client = document.getElementById("client");
    let choix = client.selectedIndex;
    let type = client.options[choix].value;
    if (type === "-1") {
        document.getElementById("clientForm").hidden= false;
    }
    else {
        document.getElementById("clientForm").hidden= true;
    }
}