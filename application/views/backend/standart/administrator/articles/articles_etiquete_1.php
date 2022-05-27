<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiquette</title>
</head>
<body>
<a class="btn btn-flat btn-info btn_print btn_action" id="print" title="Imprimer"><i class="fa fa-print"></i> Imprimer</a>
  <div class="row-etiquete" id="row-etiquete">
      <div class="box-recto">
        <div class="box-limit">
            <div class="box-red">
                <div class="img">
                  <img src="<?= base_url() ?>/asset/img/logo_gts_fait_j.png" alt="" srcset="">
                </div> 
                <div class="box-table">
                  <table class="table-red">
                    <tr>
                        <td width="2em">Article</td>
                        <td width="15em" class="donnee-design"><p><?= $articles->DESIGN_ARTICLE; ?></p></td>
                      </tr>
                      <tr>
                        <td>Codebarre</td>
                        <td>
                        <div style="padding-top: 20px">
                          <center>
                          <?php
                                $code = $articles->CODEBAR_ARTICLE;
                                echo "<img style='width:28rem;height: 10rem;' alt='Barcode' src='".base_url('qr/')."barcode.php?codetype=code128&size=50&text=".$code."&print=true'/>";
                          ?>
                          </center>
                        </div>
                        </td>
                      </tr>
                  </table>
                  
                </div>
                <div class="description">
                  <p class="description-page">
                    <?= $articles->DESCRIPTION_ARTICLE; ?>
                  </p>
                </div> 
            </div>
        </div>
      </div>
    
<style>
/* Recto */
.box-recto{
    width:80rem;
    margin: 0% 0% 0% 0;
    background-color: white;
}
.box-limit{
    padding: 2rem;
}
.box-red{
    width: 75rem;
    height: 99rem;
    border-color: #DE0520;
    border-style: solid;
    border-width: 1rem;
}
.img{
    height: 5.3rem;
    display: flex;
    justify-content: center;
}
img{
    margin-top: 0.2rem;
    color: red;
    width: 15rem;
    height: 8rem;
}
body{
  color: red;
}
.box-table{
    margin-top: 3rem;
    border-top: 0.9rem solid #DE0520;
    border-bottom: 1.3rem solid #DE0520;
    height: 23rem;
}

.table-red {
    table-layout: fixed;
    width: 100%;
    height: 10rem;
    border-collapse: collapse;
  }
  td {
    border: 2.5px solid #DE0520;
    margin: 0;
    overflow: hidden;
    font-size: 2rem;
    padding-left: 0.4rem;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    color: red;
  }
  .donnee-codebar{
    padding-left: 0rem;
    color:black;
  }
  .donnee{
    color: black;
  }
  .description{
    padding: 0.2rem 0.8rem 0.8rem 1rem;
    font-size: 2rem;
    height: 55rem;
    color: black;
    overflow: hidden;
  }
  .donnee-design{
    padding-top: 0.3rem;
    color: black;
  }

tr{
    height: 8.2rem;
}
.box-line-under{
    background-color: #DE0520;
    height: 1rem;
}
/*footer{
  display:none;
}*/ 
@media print{
    .box-recto{
      page-break-after: always;
    }
    .box-red{
      width: 67.5rem;
      height: 98.5rem;
    }
    .box-limit{
      padding: 2rem 1.7rem 1rem;
    }
    .box-table{
      height: 20rem;
    }
    .verso tr{
    height: 83px;
    }
  }
</style>
<script>
   $('#print').on('click', function() {

var table = document.getElementById('row-etiquete');
var ctx = table.outerHTML;


var idname = name;
var frame1 = document.createElement('iframe');
frame1.name = "frame1";
frame1.style.position = "absolute";
frame1.style.top = "-1000000px";
document.body.appendChild(frame1);
var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1
    .contentDocument.document : frame1.contentDocument;
frameDoc.document.open();
frameDoc.document.write('<html><head><title></title>');
frameDoc.document.write(
    
); // your title
frameDoc.document.title = "Etiquette";
frameDoc.document.write('<meta charset="utf-8"></head><body>');
frameDoc.document.write(ctx);
frameDoc.document.write('</body></html>');
frameDoc.document.close();
setTimeout(function() {
    window.frames["frame1"].focus();
    window.frames["frame1"].print();
    document.body.removeChild(frame1);
},100);


});
</script>
</div>
</body>

</html>