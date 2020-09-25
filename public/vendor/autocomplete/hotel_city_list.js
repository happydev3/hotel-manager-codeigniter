$('#destination').flexdatalist({
	minLength: 0,
	valueProperty: '*',
	selectionRequired: true,
	visibleProperties: ["name","capital","continent"],
	searchIn: 'name',
	data: 'public/vendor/autocomplete/countries.json'
});