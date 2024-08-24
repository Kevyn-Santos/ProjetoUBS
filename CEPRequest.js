function buscarEndereco() {
    const cep = document.getElementById('cep').value;
 
    // Verifica se o CEP possui 8 dígitos
    if (cep.length !== 8 || isNaN(cep)) {
        document.getElementById('cep').innerHTML =
            '<input type="text" id="cep" name="cep" placeholder="Insira um Cep valido com 8 digitos">';
        return;
    }
 
    // Faz a requisição à API ViaCEP
fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                document.getElementById('cep').innerHTML =
                    '<input type="text" id="cep" name="cep" placeholder="CEP não encontrado, tente novamente">';
            } else {
                // Preenche os campos do formulário
                document.getElementById('logradouro').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('municipio-residencia').value = data.localidade;
                //document.getElementById('Estado').value = data.uf;
 
                //document.getElementById('resultado').innerHTML = '<p>Endereço encontrado!</p>';
            }
        })
        .catch(error => {
            document.getElementById('resultado').innerHTML =
                '<input type="text" id="cep" name="cep" placeholder="Erro ao buscar o endereço. Verifique o CEP">';
        });
}