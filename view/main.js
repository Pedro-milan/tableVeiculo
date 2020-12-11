                                //ESTACIONAMENTO
const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();
const tableRegistro = document.querySelector("#registro");
const urlRegistro = "http://localhost/estacionamento/src/controll/routes/route.registro.php?id_registro=0";

                                /*LISTA TODOS OS VEICULOS CADASTRADOS*/

function listaVeiculo() {
    fetch(urlRegistro)
        .then(function (resp) {
            if (!resp.ok)
                throw new Error("Erro ao executar requisição: " + resp.status);
            return resp.json();
        })
        .then(function (data) {
            data.forEach((val) => {
                let row = document.createElement("tr");
                row.innerHTML = `<tr><td>${val.id_registro}</td>`;
                row.innerHTML += `<tr><td>${val.tipo}</td>`;
                row.innerHTML += `<tr><td>${val.placa}</td>`;
                row.innerHTML += `<tr><td>${val.entrada}</td>`;
                row.innerHTML += `<tr><td>${val.saida}</td>`;
                row.innerHTML += `<tr><td>${val.valor}</td>`;
                row.innerHTML += `<tr><td>${val.data_registro}</td>`;
                row.innerHTML += `<td style="padding:3px"><button onclick='editVeiculo(this)'>Edit</button><button onclick='delVeiculo(this)'>Del</button></td></tr>`;
                tableRegistro.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
}

                    /*CRIA O VEICULO*/

function criaVeiculo() {
    let url = "http://localhost/estacionamento/src/controll/routes/route.registro.php";
    let tipo = document.querySelector("#tipo");
    let placa = document.querySelector("#placa");
    let entrada = document.querySelector("#entrada");
    let saida = document.querySelector("#saida");
    let valor = document.querySelector("#valor");
    let data_registro = document.querySelector("#data_registro");
    if (tipo.value != "" && placa.value != "" && entrada.value != "" && saida.value != "" && valor.value != "" && data_registro.value != "") {
        let dados = new FormData();
        dados.append("tipo", tipo.value);
        dados.append("placa", placa.value);
        dados.append("entrada", entrada.value);
        dados.append("saida", saida.value);
        dados.append("valor", valor.value);
        dados.append("data_registro", data_registro.value);
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Veiculo criado com sucesso";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
        msg.innerHTML = "Favor preencher os campos.";
        setTimeout(() => { msg.innerHTML = "Mensagens do sistema"; }, 1000);
    }
}

                                /*EDITA OS VEICULOS*/

function editVeiculo(p) {
    p.parentNode.parentNode.cells[1].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[2].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[3].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[4].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[5].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[6].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[7].innerHTML = "<button onclick='putVeiculo(this)'>Enviar</button>";
}

                            /*ENVIA O FORMULARIO DE CONFIGURAÇAO DO VEICULO */

function putVeiculo(p) {
    let url = "http://localhost/estacionamento/src/controll/routes/route.registro.php";
    let id_registro = p.parentNode.parentNode.cells[0].innerHTML;
    let tipo = p.parentNode.parentNode.cells[1].innerHTML;
    let placa = p.parentNode.parentNode.cells[2].innerHTML;
    let entrada = p.parentNode.parentNode.cells[3].innerHTML;
    let saida = p.parentNode.parentNode.cells[4].innerHTML;
    let valor = p.parentNode.parentNode.cells[5].innerHTML;
    let data_registro = p.parentNode.parentNode.cells[6].innerHTML;
    
    let dados = "id_registro=" + id_registro;
    dados += "&tipo=" + tipo;
    dados += "&placa=" + placa;
    dados += "&entrada=" + entrada;
    dados += "&saida=" + saida;
    dados += "&valor=" + valor;
    dados += "&data_registro=" + data_registro;

    if (window.confirm("Confirma Alteração dos dados?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Configurações de veiculo alterado.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("PUT", url);
        xhr.send(dados);
    }
}

                                /*DELETA O VEICLO */

function delVeiculo(p) {
    let url = "http://localhost/estacionamento/src/controll/routes/route.registro.php";
    let id_registro = p.parentNode.parentNode.cells[0].innerText;
    let dados = "id_registro=" + id_registro;
    if (window.confirm("Confirma Exclusão do id " + id_registro + "?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Veiculo excluído com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("DELETE", url);
        xhr.send(dados);
    }
}
                                /*FORMULARIO DE CADASTRO */
function Enviar() {
    var nome = document.getElementById("nomeid");
    if (nome.value != "") {
        alert('Obrigado sr(a) ' + nome.value + ' os seus dados foram encaminhados com sucesso');
    }

}