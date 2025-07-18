<?php
require_once __DIR__ . '/../chave.env.php';

$pagina_css = 'contato.css';
require "includes/header.php";
?>
<main class="container my-5 position-relative pt-5">
    <div class="section-label">
        CONTATO
        <div class="underline"></div>
    </div>

    <div class="content mt-4" id="conteudo">
        <div class="grid-contato">
            <div class="informacoes-contato">
                <p><strong>Email:</strong> contato@museuciencias.org</p>
                <p><strong>Telefone:</strong> (00) 1234-5678</p>
                <p><strong>Instagram:</strong> <a href="https://instagram.com/museuciencias">instagram.com/museuciencias</a></p>
                <p><strong>Localização:</strong> Rua do Conhecimento, 123 - Centro, Cidade/Estado</p>
            </div>

            <div class="mapa-container">
                <iframe
                    id="gmp-map"
                    class="gmap"
                    frameborder="0"
                    style="border: 0;"
                    src="https://www.google.com/maps/embed/v1/place?key=<?php echo $google_maps_key; ?>&q=IFSULDEMINAS+-+Campus+Machado&zoom=15"
                    allowfullscreen>
                </iframe>
            </div>

        </div>
    </div>
</main>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_key; ?>&callback=initMap" async defer></script>


<?php
require "includes/footer.php";
?>