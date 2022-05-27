
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>

<!-- <div id="dvExcel"></div> -->
<div class="row" style="margin:10px;">
      <div class="col-md-3 col-lg-3">
        <input type="file" class="btn btn-flat btn-info" id="fileUpload" onchange="Upload()">
      </div>
      <div class="col-md-3 col-lg-3"></div>
      <div class="col-md-3 col-lg-3">
        <a class="btn btn-success pull-right" id="importFile"><span class="glyphicon glyphicon-download-alt"></span>Importer</a>
      </div>
      <div class="col-md-3 col-lg-3">
        <a href="<?php echo 'https://gts.ibi-africa.com/inventory/import/itemsToImport.xlsx' ?>" class="btn btn-success btn-md"><span class="glyphicon glyphicon-download-alt"></span> Example File</a>
      </div>
    </div>

<div id="msg"></div>
<div id="tableDiv" hidden class="table-responsive" style="width:100%; background-color: whiteSmoke;">
      <table class="table table-bordered table-striped dataTable" id="exceltable">
        <thead>
          <th>No</th>
          <th>Familles</th>
          <th>Categories</th>
          <th>Nom de l'article</th>
          <th>Prix d'achat</th>
          <th>Prix de vente</th>
          <th>Quantité</th>
          <!-- <th>Unité</th>
          <th>Reference</th>
          <th>Description</th> -->
        </thead>
        <tbody></tbody>
      </table>
    </div>


<script type="text/javascript">
    function Upload() {
        //Reference the FileUpload element.
        var fileUpload = document.getElementById("fileUpload");
 
        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
 
                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("Ce navigateur ne prend pas en charge HTML5.");
            }
        } else {
            alert("Veuillez télécharger un fichier Excel valide. XLSX et XLS");
        }
    };
    function ProcessExcel(data) {
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
 
        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];
 
        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);
        
        //Create a HTML Table element.
        var table = document.createElement("table");
        table.border = "1";
 
        //Add the header row.
        var row = table.insertRow(-1);
 
        //Add the header cells.
        var headerCell = document.createElement("TH");
        headerCell.innerHTML = "Numero";
        row.appendChild(headerCell);

        var headerCell = document.createElement("TH");
        headerCell.innerHTML = "Famille";
        row.appendChild(headerCell);
 
        headerCell = document.createElement("TH");
        headerCell.innerHTML = "Categorie";
        row.appendChild(headerCell);
 
        headerCell = document.createElement("TH");
        headerCell.innerHTML = "Article";
        row.appendChild(headerCell);

        headerCell = document.createElement("TH");
        headerCell.innerHTML = "PrixA";
        row.appendChild(headerCell);

        headerCell = document.createElement("TH");
        headerCell.innerHTML = "PrixV";
        row.appendChild(headerCell);

        headerCell = document.createElement("TH");
        headerCell.innerHTML = "Quantite";
        row.appendChild(headerCell);

        // headerCell = document.createElement("TH");
        // headerCell.innerHTML = "Unite";
        // row.appendChild(headerCell);

        // headerCell = document.createElement("TH");
        // headerCell.innerHTML = "Reference";
        // row.appendChild(headerCell);

        // headerCell = document.createElement("TH");
        // headerCell.innerHTML = "Description";
        // row.appendChild(headerCell);
 
        //Add the data rows from Excel file.

        var tableRow = "";

        for (var i = 0; i < excelRows.length; i++) {
            //Add the data row.
            var row = table.insertRow(-1);
 
            //Add the data cells.
            var cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].Numero;

            var cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].Famille;
 
            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].Categorie;
 
            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].Article;

            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].PrixA;

            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].PrixV;

            cell = row.insertCell(-1);
            cell.innerHTML = excelRows[i].Quantite;

            // cell = row.insertCell(-1);
            // cell.innerHTML = excelRows[i].Unite;

            // cell = row.insertCell(-1);
            // cell.innerHTML = excelRows[i].Reference;

            // cell = row.insertCell(-1);
            // cell.innerHTML = excelRows[i].Description;

           
            tableRow += "<tr class='notnot'><td>" + excelRows[i].Numero + "</td><td>" + excelRows[i].Famille + "</td><td>" + excelRows[i].Categorie + "</td><td>" + excelRows[i].Article + "</td><td>" + excelRows[i].PrixA + "</td><td>" + excelRows[i].PrixV + "</td><td>" + excelRows[i].Quantite + "</td></tr>";         
                 
               
        }
        $("#exceltable tbody").html(tableRow);
        // var dvExcel = document.getElementById("dvExcel");
        // dvExcel.innerHTML = "";
        // dvExcel.appendChild(table);
        $('#tableDiv').removeAttr('hidden');
    };

    function getRidOfTheComma(data) {
      var toReturn = "";
      var toFilter = data.split("");
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
      for (i = 0; i < times; i++) {
        toReturn += toMakeString[i];
      }
      return toReturn;
    }

    function stringToNumber(data) {
      var toReturn = 0;
      var toMakeInt = "";
      if (data === "") {
        return toReturn;
      } else {
        toMakeInt = getRidOfTheComma(data);
        toReturn = parseFloat(toMakeInt);
        return toReturn;
      }
    }

$(document).ready(function() {

     $("#importFile").on("click", function() {
      $("#importfile").attr('disabled', 'true');
      $("#msg").html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a><strong>WAIT!</strong> Processing!!! </div>");

      let table = [
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        // [],
        // [],
        // []
      ];

      let errors = 0;

      $("#exceltable tr.not").each(function() {
        errors += 1;
      });

      if (errors > 0) {
        $("#msg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a><strong>Danger!</strong> Il ya des erreurs qui merite votre attention.</div>");
        return false;
      }

      $("#exceltable tr.notnot").each(function() {
        let i = 0;
        $(this).find('td').each(function() {
            
          if (i === 4 || i === 5 || i === 6) {
            let element = 0;
            if (!isNaN(Number($(this).text()))) {
              element = Number($(this).text());
            }
            table[i].push(stringToNumber($(this).text()));
          } else if (i === 3) {
            if ($(this).text().split("\n").length > 0) {
              const te = $(this).text().split("\n");
              console.log(te[0]);
              table[i].push(te[0]);
            } else {
              table[i].push($(this).text());
            }
          } else {
            table[i].push($(this).text());
          }
          i += 1;
        });
        i = 0;
      });

      const dataToPost = {
        numero: JSON.stringify(table[0]),
        famille: JSON.stringify(table[1]),
        categorie: JSON.stringify(table[2]),
        article: JSON.stringify(table[3]),
        prix_achat: JSON.stringify(table[4]),
        prix_de_vente: JSON.stringify(table[5]),
        quantite: JSON.stringify(table[6]),
        // unite: JSON.stringify(table[7]),
        // reference: JSON.stringify(table[8]),
        // description: JSON.stringify(table[9]),
      };
      console.log(dataToPost);
      $.ajax({
        url: BASE_URL + 'administrator/articles/importManagement/<?=$this->uri->segment(4);?>',
        method: "POST",
        data: dataToPost,
        dataType: "json",
        success: function(data) {
          console.log(data);
          if (data.success) {
            window.location.href = data.redirect;
          } else {
            alert(data.message);
          }
        }
      });
    });

});
</script>
