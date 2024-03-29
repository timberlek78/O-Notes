const table1 = document.querySelector('.tableau-nom-etd');
const table2 = document.querySelector('.tableau-note-etd');


console.log(document.querySelector('.conteneur-visualiser'));

// Ajoute un gestionnaire d'événement de défilement à la div de conteneur de défilement
document.querySelector('.conteneur-visualiser').addEventListener('scroll', function() {
    // Applique le défilement à chaque tableau
    table1.scrollTop = this.scrollTop;
    table2.scrollTop = this.scrollTop;
});

function TableSetScroll(){
	$('#headerTop').offset(
		{
			top:$('#conteneur-visualiser').offset().top
		}
	);
	 
	$('#headerLeft').offset(
		{
			top: $('#content').offset().top
		}
	);
	 
	 
}
TableSetScroll();
$('.conteneur-visualiser').bind('scroll',TableSetScroll);
