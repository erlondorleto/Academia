
function doPost(e) {
  var sheet = SpreadsheetApp.getActiveSpreadsheet().getSheetByName("Sheet1"); 

  if (!sheet) {
    return ContentService.createTextOutput("Erro: aba não encontrada.");
  }

  
  sheet.appendRow([
    e.parameter.nome,
    e.parameter.sexo,
    e.parameter.idade,
    e.parameter.altura,
    e.parameter.peso,
  ])
        
}  
