document.getElementById("code_postal").onchange = function() {
    var xhr = new XMLHttpRequest();
    var lien = "https://apicarto.ign.fr/api/codes-postaux/communes/" + document.getElementById("code_postal").value;

    xhr.open("GET", lien, true);

    xhr.onload = function() {
        var html = "";
        if (xhr.status == 200) {
            var response = JSON.parse(xhr.response);

            for (let i = 0; i < response.length; i++) {
                html += '<option>' + response[i].nomCommune + '<option>';
            }

            html += '';
        } else {
            html = '<option> Erreur de la saisie du code postal </option>';
        }
        document.getElementById("ville").innerHTML = html;
    };
    xhr.send(); 
};

// document.getElementById("code").onchange = function() {
//     var xhr = new XMLHttpRequest();
//     var lien = "https://apicarto.ign.fr/api/codes-postaux/communes/" + document.getElementById("code").value;

//     xhr.open("GET", lien, true);

//     xhr.onload = function() {
//         var html = "";
//         if (xhr.status == 200) {
//             var response = JSON.parse(xhr.response);

//             for (let i = 0; i < response.length; i++) {
//                 html += '<option>' + response[i].nomCommune + '<option>';
//             }

//             html += '';
//         } else {
//             html = '<option> Erreur de la saisie du code postal </option>';
//         }
//         document.getElementById("ville_sortie").innerHTML = html;
//     };
//     xhr.send(); 
// };

