const table1 = document.querySelector('.liste-etd');
const table2 = document.querySelector('.liste-note');

table1.addEventListener('scroll', function() {
	table2.scrollTop = table1.scrollTop;
});

table2.addEventListener('scroll', function() {
	table1.scrollTop = table2.scrollTop;
});

// window.addEventListener('resize', function() {

// 	const tableau1 = document.querySelector('tableau-nom-etd');
// 	const tableau2 = document.querySelector('tableau-note-etd');

// 	const headerHeight = tableau1.querySelector('th').offsetHeight;
// 	tableau2.querySelector('thead').style.height = headerHeight + 'px';
// });

// function adaptationHauteur 