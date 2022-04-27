

var letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUV';
var options = [];
for (var i = 0; i < 15000; i++) {
	var title = [];
	for (var j = 0; j < 8; j++) {
		title.push(letters.charAt(Math.round((letters.length - 1) * Math.random())));
	}
	options.push({
		id: i+'-'+title.join(''),
		title: title.join('')
	});
}

new TomSelect('#select-junk',{
	maxItems: null,
	maxOptions: 100,
	valueField: 'id',
	labelField: 'title',
	searchField: 'title',
	sortField: 'title',
	options: options,
	create: false
});

