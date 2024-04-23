// register.js

// Função para registrar um novo usuário
function registerUser() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Aqui você pode implementar a lógica para enviar os dados para o servidor
    // Por enquanto, vamos apenas exibir os valores no console
    console.log('Username:', username);
    console.log('Password:', password);

    // Limpa os campos do formulário após o registro
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
}

// Adiciona um event listener para o envio do formulário
document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();
    registerUser();
});
