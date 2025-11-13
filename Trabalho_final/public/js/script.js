document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('avaliacaoForm');
    
    const perguntaIdInput = form.querySelector('input[name="pergunta_id"]');
    const isNotaPage = perguntaIdInput && perguntaIdInput.value !== 'null' && perguntaIdInput.value !== '';
    
    form.addEventListener('submit', (event) => {

        if (isNotaPage) {
            const notaSelecionada = form.querySelector('input[name="nota"]:checked');
            
            if (!notaSelecionada) {
                event.preventDefault(); // Impede o envio
                alert('Por favor, selecione uma nota de 0 a 10 para continuar.');
                
                const box = form.querySelector('.box');
                if (box) {
                    box.style.border = '2px solid red'; 
                    box.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    const radioInputs = form.querySelectorAll('input[name="nota"]');
                    radioInputs.forEach(radio => {
                        radio.addEventListener('change', () => {
                            box.style.border = '1px solid #ddd'; 
                        }, { once: true }); 
                    });
                }
            }
        }
    });
});