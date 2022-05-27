<style>
  /* body {
    position: relative;
    min-width: 1024px;
    min-height: 768px;
    height: 100%;
  } */
  /* .wrapper {
    display: grid;

    grid-template-columns: repeat(20, 1fr);

    grid-auto-rows: 50px;

  }

  .wrapper div {
    border: 1px solid;
    grid-column: span 2;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .wrapper .a {
    grid-column: span 10;

  } */
  table {
    width: 100mm;
    height: 148mm;
    background-color: white;

  }

  @page {
    size: A6;

  }

  /* table {
    width: 75rem;
    height: 99rem;
  } */

  td {
    border: 2px solid #000;
    margin: 0;
    /* font-size: 2rem; */
    padding: 0.4rem;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    color: black;
  }

  .img {
    height: 4.3rem;
    display: flex;
    justify-content: center;
  }

  .imgLogo {
    margin-top: 0.1rem;
    color: black;
    width: 15rem;
    height: 8rem;
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(95%) contrast(120%);
  }

  img {
    margin-top: 0.1rem;
    color: black;
    width: 15rem;
    height: 8rem;
  }

  .description {

    color: black;
  }

</style>


<button class="btn btn-info btn-sm hidden-print" onclick="myFunction()"><i class="fa fa-print"></i>Imprimer</button>


<table style="padding:5px;border: 15px solid black;">
  <tr>
    <td colspan="2" style="text-align:center">
      <img class="imgLogo" src="<?= base_url() ?>/asset/img/logo_gts_fait_j.png"
        alt="" srcset="">
    </td>
  </tr>
  <tr style="border-top:15px solid black;height:60px;">
    <td>Article</td>
    <td style="text-align:center;">
      <p style="font-size: 10px;"><?= $articles->DESIGN_ARTICLE; ?>
      </p>
    </td>
  </tr>
  <tr style="border-bottom:15px solid black;height: 60px;">
    <td>Prix HTVA</td>
    <td style="text-align:center;">

      <?php
          $prix = $articles->PRIX_DE_VENTE_ARTICLE;
          echo number_format($prix, 0, ',', ' ')
          ?>
    </td>
  </tr>
  <tr style="border-bottom:15px solid black;height: 60px;">
    <td>Codebarre</td>
    <td style="text-align:center;">

      <?php
          $code = $articles->CODEBAR_ARTICLE;
          // echo "<img style='width:25rem;height: 9rem;' alt='Barcode' src='".base_url('qr/')."barcode.php?codetype=code128&size=50&text=".$code."&print=true'/>";
    
          echo "<img style='width:28rem;height: 5rem;' alt='Barcode' src='".base_url('qr/')."barcode.php?codetype=code128&size=50&text=".$articles->CODEBAR_ARTICLE."&print=FALSE'/></br>".$code;
          ?>
    </td>
  </tr>
  <tr style="border-bottom:15px solid black;height:200px;">
    <td colspan="2" class="description">
      <p class="description-page">
        <?= $articles->DESCRIPTION_ARTICLE; ?>
      </p>
    </td>


  </tr>
  <tr>
  </tr>

</table>





<script>
  function myFunction() {
    window.print();
    return false;
  }

</script>
