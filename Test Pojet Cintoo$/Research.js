// Récupérer les noms depuis la base de données
let names = [];

// Utiliser une requête AJAX pour récupérer les noms de la base de données
$.ajax({
  url: 'TestProrataV2.php',
  type: 'GET',
  success: function(data) {
    names = data.names;
  }
});

// Afficher la liste déroulante lors du clic sur le champ de saisie
$('#search').click(function() {
  $('#names-list').empty();
  for (let i = 0; i < names.length; i++) {
    $('#names-list').append('<li>' + names[i] + '</li>');
  }
});

// Filtrer la liste déroulante en fonction de la saisie de l'utilisateur
$('#search').on('input', function() {
  let searchValue = $(this).val().toLowerCase();
  let filteredNames = names.filter(function(name) {
    return name.toLowerCase().includes(searchValue);
  });
  $('#names-list').empty();
  for (let i = 0; i < filteredNames.length; i++) {
    $('#names-list').append('<li>' + filteredNames[i] + '</li>');
  }
});

// Remplir le champ de saisie avec le nom sélectionné
$('#names-list').on('click', 'li', function() {
  let selectedName = $(this).text();
  $('#search').val(selectedName);
  $('#names-list').empty();
});
