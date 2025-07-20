<?php require "views/includes/header.php"; ?>
<section class="inicio-cards py-5 bg-custom">
  <div class="container">
    <div class="row text-center g-4">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <i class="bi bi-info-circle-fill text-custom"></i>
            <h5 class="card-title mt-3">Conheça</h5>
            <p class="card-text">Saiba o que esperar visualizar no dia da visita.</p>
            <a href="/ProjetoMuseu/views/visitas.php" class="btn btn-outline-success mt-2">Conhecer Espaço</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <i class="bi bi-geo-alt-fill text-custom"></i>
            <h5 class="card-title mt-3">Localização</h5>
            <p class="card-text">Estamos no IFSULDEMINAS - Machado, de fácil acesso e ambiente acolhedor.</p>
            <a href="/ProjetoMuseu/views/contato.php" class="btn btn-outline-success mt-2">Ver no mapa</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <i class="bi bi-calendar-check-fill text-custom"></i>
            <h5 class="card-title mt-3">Visite</h5>
            <p class="card-text">Aberto de Segunda a Sexta<br> Entrada gratuita!</p>
            <a href="/ProjetoMuseu/views/agendamento.php" class="btn btn-outline-success mt-2">Planeje sua visita</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="historia-section py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7">
        <h2 class="fw-bold">Um museu com alma e história</h2>
        <p class="mt-3">
          Fundado para preservar a memória da região, o Museu de Ciências se tornou um espaço de aprendizado, inspiração e diálogo entre gerações. Conheça o projeto por trás desse espaço educativo.
        </p>
        <a href="/ProjetoMuseu/views/sobre.php" class="btn btn-outline-success mt-3">Leia mais sobre o museu</a>
      </div>
      <div class="col-md-5 text-center">
        <img src="/ProjetoMuseu/static/imagens/foto1.jpeg" alt="Museu" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</section>


<section class="guia-visita py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Guia para sua visita</h2>
      <p class="text-muted">Dicas rápidas para você aproveitar ao máximo!</p>
    </div>
    <div class="row text-center g-4">
      <div class="col-md-4">
        <i class="bi bi-people-fill text-custom"></i>
        <h5 class="mt-3">Grupos recomendados</h5>
        <p class="text-muted">Ideal para grupos de até 30 pessoas por visita guiada.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-hourglass-split text-custom"></i>
        <h5 class="mt-3">Duração</h5>
        <p class="text-muted">A visita dura em média de 35 a 40 minutos.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-exclamation-circle-fill text-custom"></i>
        <h5 class="mt-3">Importante saber</h5>
        <p class="text-muted">Recomenda-se chegar com 10 minutos de antecedência.</p>
      </div>
    </div>
  </div>
</section>



<?php require "views/includes/footer.php"; ?>
