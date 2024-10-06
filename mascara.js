
function mascaraTelefone(input){
    let campo = input.value.replace(/\D/g, ''); //substitui todos os digitos não numericos por uma string vazia, isso impede de colocar letras no campo


    if(campo.length > 10){
        campo = campo.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    } else if (campo.length > 6) {
        campo = campo.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3'); // Formato (xx) xxxx-xxxx
    } else if (campo.length > 2) {
        campo = campo.replace(/(\d{2})(\d+)/, '($1) $2'); // Formato (xx) xx...
    }

    input.value = campo;
}

/*
    as letras seguidas de numeros são expressoes regulares, elas funcionam da seguinte forma:
    d{x} indica um grupo de captura, com "d" significando digitos e o "x" representando quantos digitos são capturados
    então a primeira parte da função diz para capturar um certo numero de digitos.

    o $x, indica qual grupo de captura será modificado, sendo assim $1 modifica o primeiro grupo de captura que aparecer, o $2 modifica o segundo grupo que aparecer 
    e o $3 modifica o terceiro grupo que aparecer.

    A modificação que será feita é idicada pelos simbolos que os acompanham, então para o primerio grupo será adicionado dois parenteses ao redor, 
    e para o segundo e terceiro grupos de captura será adicionado um traço entre eles.

    então num geral a função diz, pegue os dois primeiros digitos e adicione um parenteses entre eles, 
    depois adicione um espaço e pegue os proximos cinco digitos, após eles adicione um traço
    por fim pegue os quatro ultimos digitos e os coloque junto com o traço anteriormente colocado.

    por fim, substitua o campo de digitação com a nova formatação (input.value = campo)
*/

