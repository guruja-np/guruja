var getKeyByValue = function (object, value) {
	return Object.keys(object).find(key => object[key] === value);
}
var getObjectIndex = function (key, value) {
	for (var i = 0; i < this.length;)
		if (this[i++][key] === value) return --i;
	return -1;
}
var objectToArray = function (obj) {
	return Object.keys(obj).map(key => [Number(key), obj[key]]);
}
var groupBy = function (objectArray, property) {
	return objectArray.reduce((acc, obj) => {
		const key = obj[property];
		if (!acc[key]) {
			acc[key] = [];
		}
		acc[key].push(obj);
		return acc;
	}, {});
}
//lodash required
var filterObject = function (objectArray, keys) {
	let filteredObj = [];
	_.forEach(objectArray, obj => {
		const filteringObj = _.pick(obj, keys);
		filteredObj.push(filteringObj);
	});
	return filteredObj;
}
var smoothScrollIntoView = function (identifier) {
	setTimeout(() => {
		document.querySelector(identifier).scrollIntoView({
			behavior: "smooth"
		});
	}, 500);
}
var ifUrlExist = function (url, callback) {
	if (url == '' || url == null)
		return false
	let request = new XMLHttpRequest();
	request.open("GET", url, true);
	request.setRequestHeader(
		"Content-Type",
		"application/x-www-form-urlencoded; charset=UTF-8"
	);
	request.setRequestHeader("Accept", "*/*");
	request.onprogress = function (event) {
		let status = event.target.status;
		let statusFirstNumber = status.toString()[0];
		switch (statusFirstNumber) {
			case "2":
				request.abort();
				return callback(true);
			default:
				request.abort();
				return callback(false);
		}
	};
	request.send("");
}
var convertToFormData = function (item) {
	var form_data = new FormData();
	for (var key in item) {
		if (item[key] != undefined)
			form_data.append(key, item[key]);
	}
	return form_data;
}
var fileToDataUrl = function (inputFile, callback) {
	if (inputFile != null && typeof (inputFile) === 'object') {
		let file = inputFile,
			reader = new FileReader()

		reader.readAsDataURL(file)
		reader.onload = e => callback(e.target.result)
	}
}

var notify = function (message = '', type = 'info', timeOut = 2000) {
	let event = new CustomEvent("notice", {
		detail: {
			type: type,
			text: message,
			timeOut: timeOut
		}
	});
	window.dispatchEvent(event);
}
var noticesHandler = function () {
	return {
		notices: [],
		visible: [],
		add(notice) {
			notice.id = Date.now()
			this.notices.push(notice)
			this.fire(notice.id, notice.timeOut)
		},
		fire(id, timeOut) {
			this.visible.push(this.notices.find(notice => notice.id == id))
			const timeShown = timeOut * this.visible.length
			setTimeout(() => {
				this.remove(id)
			}, timeShown)
		},
		remove(id) {
			const notice = this.visible.find(notice => notice.id == id)
			const index = this.visible.indexOf(notice)
			this.visible.splice(index, 1)
		},
	}
}

var stingInitials = function (string, separator = ".") {

	return string != undefined && string.length > 0 ? string.split(" ").map((n) => n[0].toUpperCase()).join(separator) : '';
}

var matchedObjectData = function (sourceObject, dataObject) {

	return Object.keys(sourceObject)
		.reduce((a, key) => ({ ...a, [key]: dataObject[key] }), {});

}


var resetValue = function (obj) {

	var newObj = {};
	for (var key in obj) {
		if (key == 'account_create')
			newObj[key] = false
		else
			newObj[key] = ''
	}
	return newObj;
}
var getDataTableOptions = function (opt) {
	let btn = '<"dt-export-buttons d-flex align-center"<"dt-export-title d-none d-md-inline-block">B>', btn_cls = ' with-export';
	let editedDom = `<"row justify-between g-2 ${btn_cls}"
	<"col-7 col-sm-4 text-left"f>
	<"col-5 col-sm-8 text-right"
	<"datatable-filter"
	<"d-flex justify-content-end g-2"${btn}l>>>>
	<"datatable-wrap my-3"t>
	<"row align-items-center"
	<"col-7 col-sm-12 col-md-9"p>
	<"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>`;
	let fileName = opt && opt.hasOwnProperty('fileName') ? opt.fileName : ''
	let def = {
		dom: editedDom,
		scrollX: true,
		buttons: [
			{
				extend: 'excelHtml5',
				title: '',
				filename: fileName,
				exportOptions: {
					columns: [0, ':not(.noExport)']
					// 
				}
			},
			{
				extend: 'pdfHtml5',
				title: '',
				filename: fileName,
				exportOptions: {
					columns: [0, ':not(.noExport)']
				}
			},
			{
				extend: 'print',
				title: '',
				filename: fileName,
				autoPrint: true,
				exportOptions: {
					columns: [0, ':not(.noExport)']
				}
			},
			'colvis'
		],
		scrollY: '60vh',
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		autoWidth: false,
		destroy: true,
		processing: true,
		language: {
			search: "",
			searchPlaceholder: "Type in to Search",
			lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
			info: "_START_ -_END_ of _TOTAL_",
			infoEmpty: "No records found",
			infoFiltered: "( Total _MAX_  )",
			paginate: {
				"first": "First",
				"last": "Last",
				"next": "Next",
				"previous": "Prev"
			}
		},
		columnDefs: [{
			"searchable": false,
			"orderable": false,
			"targets": 0,
		}],
		// order: [[1, 'asc']],
		// initComplete: function (settings, json) {
		// 	var api = this.api();
		// 	console.log('here');
		// 	api.on('order.dt search.dt', function () {
		// 		let i = 1;
		// 		// api.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
		// 		// 	this.data(i++);
		// 		// });
		// 	}).draw();
		// }
	}
	attr = opt ? extend(def, opt) : def;
	return attr;
}

var extend = function (obj, ext) {
	Object.keys(ext).forEach(function (key) {
		obj[key] = ext[key];
	});
	return obj;
}

var jsonStringParser = function (data) {
	return JSON.stringify(data).replace(/"/g, "&quot;").replace(/'/g, "&#039;")
}

var getFirstLetters = function (str) {
	return str.split(' ').map(word => word.charAt(0)).join('');
}