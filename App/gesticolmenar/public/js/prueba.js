let loginForm = document.getElementById('loginForm');

loginForm.addEventListener('submit', event => {
  event.preventDefault();
  alert('Formulario enviado');
});