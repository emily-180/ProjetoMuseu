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
                <p><i class="bi bi-envelope-fill me-2 icon-contato text-success"></i><strong>Email:</strong> contato@museuciencias.org</p>
                <p><i class="bi bi-telephone-fill me-2 icon-contato text-success"></i><strong>Telefone:</strong> (35) 3437-5678</p>
                <p><i class="bi bi-instagram me-2 icon-contato text-success"></i><strong>Instagram:</strong> <a href="https://instagram.com/museuciencias" target="_blank">@museu_josealencardecarvalho</a></p>
                <p><i class="bi bi-geo-alt-fill me-2 icon-contato text-success"></i><strong>Localização:</strong> 
              Rod. Machado - Paraguaçu, KM 03, Santo Antonio, Machado-MG </p>
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