//Javascript Document

//var someObject = {
//	'part1' : {
//		'name': 'Part 1',
//		'size': '20',
//		'qty' : '50'
//	},
//	'part2' : {
//		'name': 'Part 2',
//		'size': '15',
//		'qty' : '60'
//	},
//	'part3' : [
//		{
//			'name': 'Part 3A',
//			'size': '10',
//			'qty' : '20'
//		}, {
//			'name': 'Part 3B',
//			'size': '5',
//			'qty' : '20'
//		}, {
//			'name': 'Part 3C',
//			'size': '7.5',
//			'qty' : '20'
//		}
//	]
//};
// Usage: Object.byString(someObj, 'part3[0].name');
Object.byString = function(o, s) {
	s = s.replace(/\[(\w+)\]/g, '.$1'); // convert indexes to properties
	s = s.replace(/^\./, '');           // strip a leading dot
	var a = s.split('.');
	for (var i = 0, n = a.length; i < n; ++i) {
		var k = a[i];
		if (k in o) {
			o = o[k];
		} else {
			return;
		}
	}
	return o;
}

/**
 * [isObject description]
 * @param  {[type]}  val [description]
 * @return {Boolean}     [description]
 */
Object.isObject = function (val) {
	if (val === null) { return false;}
	return ( (typeof val === 'function') || (typeof val === 'object') );
}
/* Otra alternativa que dicen que funciona
Object.isObject = function (obj) {
	return obj === Object(obj);
}
*/