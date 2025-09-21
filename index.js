
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
    e.parameter.nascimento,
    e.parameter.lesoes,
    e.parameter.objetivo,
    e.parameter.nivel,
    e.parameter.frequencia,
    e.parameter.duracao,
    e.parameter.feedback,
    e.parameter.consentimento
  ]);


  var mensagem = `
    Novo envio de Sheet1:

    Nome: ${e.parameter.nome}
    Sexo: ${e.parameter.sexo}
    Idade: ${e.parameter.idade}
    Altura: ${e.parameter.altura} cm
    Peso: ${e.parameter.peso} kg
    Nascimento: ${e.parameter.nascimento}
    Lesões: ${e.parameter.lesoes}
    Objetivo: ${e.parameter.objetivo}
    Nível: ${e.parameter.nivel}
    Frequência: ${e.parameter.frequencia}
    Duração: ${e.parameter.duracao}
    Feedback: ${e.parameter.feedback}
    Consentimento: ${e.parameter.consentimento}
  `;

   MailApp.sendEmail({
    to: "erlondorleto9@gmail.com",
    subject: "📩 Novo formulário recebido",
    body: mensagem
  });

  return ContentService.createTextOutput("✅ Dados recebidos com sucesso!");
}

 
 
