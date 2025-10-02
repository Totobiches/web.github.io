document.addEventListener('DOMContentLoaded', function() {
    const dniInput = document.getElementById('dni');
    const consultarBtn = document.getElementById('consultarBtn');

    consultarBtn.addEventListener('click', function() {
        const dni = dniInput.value.trim();

        if (dni.length !== 8 || isNaN(dni)) {
            alert("Por favor, ingresa un DNI válido de 8 dígitos.");
            return;
        }
        const numeroWhatsapp = "5491126011571"; 
        const mensaje = `Hola, me gustaría saber dónde votó, mi DNI ${dni}`;

        window.open(`https://wa.me/${numeroWhatsapp}?text=${encodeURIComponent(mensaje)}`, '_blank');
    });

    dniInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            consultarBtn.click();
        }
    });
});
