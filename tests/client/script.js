const form = document.getElementById('cadastroForm');
const resultado = document.getElementById('resultado');

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  const nome = document.getElementById('nome').value.trim();
  const email = document.getElementById('email').value.trim();

  if (!nome || !email) {
    resultado.textContent = 'Preencha todos os campos.';
    resultado.style.color = 'red';
    return;
  }

  try {
    const response = await fetch('http://localhost:9090/public/index.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ nome, email })
    });

    const data = await response.json();

    if (response.ok) {
      resultado.textContent = data.mensagem;
      resultado.style.color = '#0f0';
        form.reset();
    } else {
      resultado.textContent = data.erro || 'Erro no servidor';
      resultado.style.color = 'red';
    }
  } catch (error) {
    resultado.textContent = 'Falha na conexão com a API.';
    resultado.style.color = 'red';
  }
});
