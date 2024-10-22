// Selecionar o botão e o conteúdo
const accordionButton = document.querySelector('.topicos');
const accordionContent = document.querySelector('.content');

// Adicionar evento de clique ao botão
accordionButton.addEventListener('click', function () {
    // Alterna a exibição do conteúdo
    accordionContent.classList.toggle('show');
});
function submitForm(actionValue) {
    // Altera o valor do campo oculto "acao" com base no botão clicado
    document.querySelector('input[name="acao"]').value = actionValue;

    // Submete o formulário invisível
    document.getElementById('invisible-form').submit();
}
function logout(event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
}