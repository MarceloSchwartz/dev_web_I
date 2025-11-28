document.addEventListener('DOMContentLoaded', () => {
    const containerAgradecimento = document.querySelector('.container.agradecimento');
    
    if (containerAgradecimento) {
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 3000); 
    }
});