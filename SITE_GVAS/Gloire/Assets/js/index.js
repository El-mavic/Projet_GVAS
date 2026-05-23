
            // blocs

            function ouvrir() {
                document.getElementById('fenetre').style.display = 'block';
            }
            function fermer() {
                document.getElementById('fenetre').style.display = 'none';
            }
            // Quand tu clique à coté le fenetre doit se fermé
            window.onclick = function (event) {
                const modal = document.getElementById('fenetre');

                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }