function buscarEndereco() {
    let cep = document.getElementById('cep').value;
    /*cep.replace('-', ''); //Deveria substiruir quaisquer valores indesejados por uma string vazia
    cep.trim();*/

    // Verifica se o CEP possui 8 dígitos
    if (cep.length !== 8 || isNaN(cep)) {
        document.getElementById('cep').innerHTML =
            alert('Insira um Cep valido com 8 digitos');
        return;
    }
 
 
    // Faz a requisição à API ViaCEP
fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                document.getElementById('cep').innerHTML =
                    alert('CEP não encontrado, tente novamente');
            } else {
                // Preenche os campos do formulário
                document.getElementById('logradouro').value = data.logradouro;
                document.getElementById('logradouro').readOnly = "true";
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('bairro').readOnly = "true";
                let MunicipioR = document.getElementById('municipio-residencia').value = data.localidade;
                document.getElementById('municipio-residencia').readOnly = "true";
                document.getElementById('uf-residencia').value = data.uf;
                document.getElementById('codigo-ibge-residencia').value = data.ibge;
                document.getElementById('codigo-ibge-residencia').readOnly ="true";
                document.getElementById('telefone').value = data.ddd;
                document.getElementById('telefone').readOnly ="true";
                document.getElementById('complemento').value = data.complemento;

                if(MunicipioR == "Franco da Rocha" || MunicipioR == "Caieiras" || MunicipioR == "Mairiporã" || MunicipioR == "Francisco Morato"){
                    document.getElementById('destrito').value = "Unidade Administrativa Autônoma";
                    document.getElementById('destrito').readOnly = "true";
                } else{
                    document.getElementById('destrito').value = "";
                    document.getElementById('destrito').readOnly = "true";
                }

                //document.getElementById('resultado').innerHTML = '<p>Endereço encontrado!</p>';
            }
        })
        .catch(error => {
            document.getElementById('cep').innerHTML =
                alert('Erro ao buscar o endereço. Verifique o CEP');
        });
}

