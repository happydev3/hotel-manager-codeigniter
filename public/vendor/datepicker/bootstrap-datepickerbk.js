/* =========================================================
 * bootstrap-datepicker.js 
 * http://www.eyecon.ro/bootstrap-datepicker
 * =========================================================
 * Copyright 2012 Stefan Petre
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */
 
!function( $ ) {
	
	// Picker object
	
	var Datepicker = function(element, options){
		this.element = $(element);
		this.format = DPGlobal.parseFormat(options.format||this.element.data('date-format')||'mm/dd/yyyy');
		this.picker = $(DPGlobal.template)
							.appendTo('body')
							.on({
								click: $.proxy(this.click, this)//,
								//mousedown: $.proxy(this.mousedown, this)
							});
		this.isInput = this.element.is('input');
		this.component = this.element.is('.date') ? this.element.find('.add-on') : false;
		
		if (this.isInput) {
			this.element.on({
				focus: $.proxy(this.show, this),
				//blur: $.proxy(this.hide, this),
				keyup: $.proxy(this.update, this)
			});
		} else {
			if (this.component){
				this.component.on('click', $.proxy(this.show, this));
			} else {
				this.element.on('click', $.proxy(this.show, this));
			}
		}
	
		this.minViewMode = options.minViewMode||this.element.data('date-minviewmode')||0;
		if (typeof this.minViewMode === 'string') {
			switch (this.minViewMode) {
				case 'months':
					this.minViewMode = 1;
					break;
				case 'years':
					this.minViewMode = 2;
					break;
				default:
					this.minViewMode = 0;
					break;
			}
		}
		this.viewMode = options.viewMode||this.element.data('date-viewmode')||0;
		if (typeof this.viewMode === 'string') {
			switch (this.viewMode) {
				case 'months':
					this.viewMode = 1;
					break;
				case 'years':
					this.viewMode = 2;
					break;
				default:
					this.viewMode = 0;
					break;
			}
		}
		this.startViewMode = this.viewMode;
		this.weekStart = options.weekStart||this.element.data('date-weekstart')||0;
		this.weekEnd = this.weekStart === 0 ? 6 : this.weekStart - 1;
		this.onRender = options.onRender;
		this.fillDow();
		this.fillMonths();
		this.update();
		this.showMode();
	};
	
	Datepicker.prototype = {
		constructor: Datepicker,
		
		show: function(e) {
			this.picker.show();
			this.height = this.component ? this.component.outerHeight() : this.element.outerHeight();
			this.place();
			$(window).on('resize', $.proxy(this.place, this));
			if (e ) {
				e.stopPropagation();
				e.preventDefault();
			}
			if (!this.isInput) {
			}
			var that = this;
			$(document).on('mousedown', function(ev){
				if ($(ev.target).closest('.datepicker').length == 0) {
					that.hide();
				}
			});
			this.element.trigger({
				type: 'show',
				date: this.date
			});
		},
		
		hide: function(){
			this.picker.hide();
			$(window).off('resize', this.place);
			this.viewMode = this.startViewMode;
			this.showMode();
			if (!this.isInput) {
				$(document).off('mousedown', this.hide);
			}
			//this.set();
			this.element.trigger({
				type: 'hide',
				date: this.date
			});
		},
		
		set: function() {
			var formated = DPGlobal.formatDate(this.date, this.format);
			if (!this.isInput) {
				if (this.component){
					this.element.find('input').prop('value', formated);
				}
				this.element.data('date', formated);
			} else {
				this.element.prop('value', formated);
			}
		},
		
		setValue: function(newDate) {
			if (typeof newDate === 'string') {
				this.date = DPGlobal.parseDate(newDate, this.format);
			} else {
				this.date = new Date(newDate);
			}
			this.set();
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},
		
		place: function(){
			var offset = this.component ? this.component.offset() : this.element.offset();
			this.picker.css({
				top: offset.top + this.height,
				left: offset.left
			});
		},
		
		update: function(newDate){
			this.date = DPGlobal.parseDate(
				typeof newDate === 'string' ? newDate : (this.isInput ? this.element.prop('value') : this.element.data('date')),
				this.format
			);
			this.viewDate = new Date(this.date.getFullYear(), this.date.getMonth(), 1, 0, 0, 0, 0);
			this.fill();
		},
		
		fillDow: function(){
			var dowCnt = this.weekStart;
			var html = '<tr>';
			while (dowCnt < this.weekStart + 7) {
				html += '<th class="dow">'+DPGlobal.dates.daysMin[(dowCnt++)%7]+'</th>';
			}
			html += '</tr>';
			this.picker.find('.datepicker-days thead').append(html);
		},
		
		fillMonths: function(){
			var html = '';
			var i = 0
			while (i < 12) {
				html += '<span class="month">'+DPGlobal.dates.monthsShort[i++]+'</span>';
			}
			this.picker.find('.datepicker-months td').append(html);
		},
		
		fill: function() {
			var d = new Date(this.viewDate),
				year = d.getFullYear(),
				month = d.getMonth(),
				currentDate = this.date.valueOf();
			this.picker.find('.datepicker-days th:eq(1)')
						.text(DPGlobal.dates.months[month]+' '+year);
			var prevMonth = new Date(year, month-1, 28,0,0,0,0),
				day = DPGlobal.getDaysInMonth(prevMonth.getFullYear(), prevMonth.getMonth());
			prevMonth.setDate(day);
			prevMonth.setDate(day - (prevMonth.getDay() - this.weekStart + 7)%7);
			var nextMonth = new Date(prevMonth);
			nextMonth.setDate(nextMonth.getDate() + 42);
			nextMonth = nextMonth.valueOf();
			var html = [];
			var clsName,
				prevY,
				prevM;
			while(prevMonth.valueOf() < nextMonth) {
				if (prevMonth.getDay() === this.weekStart) {
					html.push('<tr>');
				}
				clsName = this.onRender(prevMonth);
				prevY = prevMonth.getFullYear();
				prevM = prevMonth.getMonth();
				if ((prevM < month &&  prevY === year) ||  prevY < year) {
					clsName += ' old';
				} else if ((prevM > month && prevY === year) || prevY > year) {
					clsName += ' new';
				}
				if (prevMonth.valueOf() === currentDate) {
					clsName += ' active';
				}
				html.push('<td class="day '+clsName+'">'+prevMonth.getDate() + '</td>');
				if (prevMonth.getDay() === this.weekEnd) {
					html.push('</tr>');
				}
				prevMonth.setDate(prevMonth.getDate()+1);
			}
			this.picker.find('.datepicker-days tbody').empty().append(html.join(''));
			var currentYear = this.date.getFullYear();
			
			var months = this.picker.find('.datepicker-months')
						.find('th:eq(1)')
							.text(year)
							.end()
						.find('span').removeClass('active');
			if (currentYear === year) {
				months.eq(this.date.getMonth()).addClass('active');
			}
			
			html = '';
			year = parseInt(year/10, 10) * 10;
			var yearCont = this.picker.find('.datepicker-years')
								.find('th:eq(1)')
									.text(year + '-' + (year + 9))
									.end()
								.find('td');
			year -= 1;
			for (var i = -1; i < 11; i++) {
				html += '<span class="year'+(i === -1 || i === 10 ? ' old' : '')+(currentYear === year ? ' active' : '')+'">'+year+'</span>';
				year += 1;
			}
			yearCont.html(html);
		},
		
		click: function(e) {
			e.stopPropagation();
			e.preventDefault();
			var target = $(e.target).closest('span, td, th');
			if (target.length === 1) {
				switch(target[0].nodeName.toLowerCase()) {
					case 'th':
						switch(target[0].className) {
							case 'switch':
								this.showMode(1);
								break;
							case 'prev':
							case 'next':
								this.viewDate['set'+DPGlobal.modes[this.viewMode].navFnc].call(
									this.viewDate,
									this.viewDate['get'+DPGlobal.modes[this.viewMode].navFnc].call(this.viewDate) + 
									DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1)
								);
								this.fill();
								this.set();
								break;
						}
						break;
					case 'span':
						if (target.is('.month')) {
							var month = target.parent().find('span').index(target);
							this.viewDate.setMonth(month);
						} else {
							var year = parseInt(target.text(), 10)||0;
							this.viewDate.setFullYear(year);
						}
						if (this.viewMode !== 0) {
							this.date = new Date(this.viewDate);
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						this.showMode(-1);
						this.fill();
						this.set();
						break;
					case 'td':
						if (target.is('.day') && !target.is('.disabled')){
							var day = parseInt(target.text(), 10)||1;
							var month = this.viewDate.getMonth();
							if (target.is('.old')) {
								month -= 1;
							} else if (target.is('.new')) {
								month += 1;
							}
							var year = this.viewDate.getFullYear();
							this.date = new Date(year, month, day,0,0,0,0);
							this.viewDate = new Date(year, month, Math.min(28, day),0,0,0,0);
							this.fill();
							this.set();
							this.element.trigger({
								type: 'changeDate',
								date: this.date,
								viewMode: DPGlobal.modes[this.viewMode].clsName
							});
						}
						break;
				}
			}
		},
		
		mousedown: function(e){
			e.stopPropagation();
			e.preventDefault();
		},
		
		showMode: function(dir) {
			if (dir) {
				this.viewMode = Math.max(this.minViewMode, Math.min(2, this.viewMode + dir));
			}
			this.picker.find('>div').hide().filter('.datepicker-'+DPGlobal.modes[this.viewMode].clsName).show();
		}
	};
	
	$.fn.datepicker = function ( option, val ) {
		return this.each(function () {
			var $this = $(this),
				data = $this.data('datepicker'),
				options = typeof option === 'object' && option;
			if (!data) {
				$this.data('datepicker', (data = new Datepicker(this, $.extend({}, $.fn.datepicker.defaults,options))));
			}
			if (typeof option === 'string') data[option](val);
		});
	};

	$.fn.datepicker.defaults = {
		onRender: function(date) {
			return '';
		}
	};
	$.fn.datepicker.Constructor = Datepicker;
	
	var DPGlobal = {
		modes: [
			{
				clsName: 'days',
				navFnc: 'Month',
				navStep: 1
			},
			{
				clsName: 'months',
				navFnc: 'FullYear',
				navStep: 1
			},
			{
				clsName: 'years',
				navFnc: 'FullYear',
				navStep: 10
		}],
		dates:{
			days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
			daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
			months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
		},
		isLeapYear: function (year) {
			return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0))
		},
		getDaysInMonth: function (year, month) {
			return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month]
		},
		parseFormat: function(format){
			var separator = format.match(/[.\/\-\s].*?/),
				parts = format.split(/\W+/);
			if (!separator || !parts || parts.length === 0){
				throw new Error("Invalid date format.");
			}
			return {separator: separator, parts: parts};
		},
		parseDate: function(date, format) {
			var parts = date.split(format.separator),
				date = new Date(),
				val;
			date.setHours(0);
			date.setMinutes(0);
			date.setSeconds(0);
			date.setMilliseconds(0);
			if (parts.length === format.parts.length) {
				var year = date.getFullYear(), day = date.getDate(), month = date.getMonth();
				for (var i=0, cnt = format.parts.length; i < cnt; i++) {
					val = parseInt(parts[i], 10)||1;
					switch(format.parts[i]) {
						case 'dd':
						case 'd':
							day = val;
							date.setDate(val);
							break;
						case 'mm':
						case 'm':
							month = val - 1;
							date.setMonth(val - 1);
							break;
						case 'yy':
							year = 2000 + val;
							date.setFullYear(2000 + val);
							break;
						case 'yyyy':
							year = val;
							date.setFullYear(val);
							break;
					}
				}
				date = new Date(year, month, day, 0 ,0 ,0);
			}
			return date;
		},
		formatDate: function(date, format){
			var val = {
				d: date.getDate(),
				m: date.getMonth() + 1,
				yy: date.getFullYear().toString().substring(2),
				yyyy: date.getFullYear()
			};
			val.dd = (val.d < 10 ? '0' : '') + val.d;
			val.mm = (val.m < 10 ? '0' : '') + val.m;
			var date = [];
			for (var i=0, cnt = format.parts.length; i < cnt; i++) {
				date.push(val[format.parts[i]]);
			}
			return date.join(format.separator);
		},
		headTemplate: '<thead>'+
							'<tr>'+
								'<th class="prev">&lsaquo;</th>'+
								'<th colspan="5" class="switch"></th>'+
								'<th class="next">&rsaquo;</th>'+
							'</tr>'+
						'</thead>',
		contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>'
	};
	DPGlobal.template = '<div class="datepicker dropdown-menu">'+
							'<div class="datepicker-days">'+
								'<table class=" table-condensed">'+
									DPGlobal.headTemplate+
									'<tbody></tbody>'+
								'</table>'+
							'</div>'+
							'<div class="datepicker-months">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
								'</table>'+
							'</div>'+
							'<div class="datepicker-years">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
								'</table>'+
							'</div>'+
						'</div>';

}( window.jQuery );


//datepicker code
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var dateStr = nowTemp.getDate() + "/" + nowTemp.getMonth() + "/" + nowTemp.getFullYear();

$currenturl = location.href;
$val1 = $currenturl.includes("/villas/itinerary"); 
var availDates = '';
if ($val1){
	availDates = available;
}

//date picker for Holidays
var checkinHD = $('#dphd').datepicker({
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkinHD.hide();
}).data('datepicker');

//date picker for bus
var checkinB1 = $('#dpb1').datepicker({
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkinB1.hide();
}).data('datepicker');

var checkinB2 = $('#dpb2').datepicker({
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkinB2.hide();
}).data('datepicker');

var checkinDP = $('.dp').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkinDP.hide();
  $('.datepicker').hide();
}).data('datepicker');

//date picker for flights
var checkinF = $('#dpf1').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkoutF.date.valueOf()) {
	var newDate = new Date(ev.date)
	newDate.setDate(newDate.getDate() + 1);
	checkoutF.setValue(newDate);
  }
  checkinF.hide();
  focusObj($('#dpf2')[0],'focus');
}).data('datepicker');
var checkoutF = $('#dpf2').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() <= checkinF.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkoutF.hide();
}).data('datepicker');



//date picker for hotels
var checkinH = $('#dph1').datepicker({
  format: 'dd/mm/yyyy',
  // defaultDate: dateStr,
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkoutH.date.valueOf()) {
	var newDate = new Date(ev.date)
	newDate.setDate(newDate.getDate() + 1);
	checkoutH.setValue(newDate);
  }
  checkinH.hide();
  focusObj($('#dph2')[0],'focus');
}).data('datepicker');

var checkoutH = $('#dph2').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() <= checkinH.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkoutH.hide();
  focusObj($(this).closest('form').find('.travellers-input-popup'),'show');
}).data('datepicker');

//date picker for tours
var checkinT = $('#dpt1').datepicker({
  format: 'dd/mm/yyyy',
  // defaultDate: dateStr,
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkoutT.date.valueOf()) {
	var newDate = new Date(ev.date)
	newDate.setDate(newDate.getDate() + 1);
	checkoutT.setValue(newDate);
  }
  checkinT.hide();
  focusObj($('#dpt2')[0],'focus');
}).data('datepicker');

var checkoutT = $('#dpt2').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() <= checkinT.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkoutT.hide();
  focusObj($(this).closest('form').find('.travellers-input-popup'),'show');
}).data('datepicker');

// Datepicker for rooms rate
var checkinR = $('#dpr1').datepicker({
  format: 'dd/mm/yyyy',
  // defaultDate: dateStr,
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkoutR.date.valueOf()) {
	var newDate = new Date(ev.date)
	newDate.setDate(newDate.getDate() + 1);
	checkoutR.setValue(newDate);
  }
  checkinR.hide();
  focusObj($('#dpr2')[0],'focus');
}).data('datepicker');

var checkoutR = $('#dpr2').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() <= checkinR.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkoutR.hide();
}).data('datepicker');


// Datepicker for villas
var checkinV = $('#dpv1').datepicker({
  format: 'dd/mm/yyyy',
  // defaultDate: dateStr,
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkoutV.date.valueOf()) {
	var newDate = new Date(ev.date)
	newDate.setDate(newDate.getDate() + 1);
	checkoutV.setValue(newDate);
  }
  checkinV.hide();
  focusObj($('#dpv2')[0],'focus');
}).data('datepicker');

var checkoutV = $('#dpv2').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() <= checkinV.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkoutV.hide();
  focusObj($(this).closest('form').find('.travellers-input-popup'),'show');
}).data('datepicker');

// Booking rate


var checkinVA = $('#dpvv1').datepicker({
	format: 'dd/mm/yyyy',
	// minDate: new Date(),
	// maxDate: new Date(new Date().setDate(todayDate + 30))
	// defaultDate: dateStr,
	beforeShowDay: availDates,
	onRender: function(date) {
		return date.valueOf() < now.valueOf() ? 'disabled' : '';
	}
}).on('changeDate', function(ev) {
	var newDate = new Date(ev.date);
	if($('input[name="price_type"]').val() == '2') {
		newDate.setDate(newDate.getDate() + 7);
		checkoutVA.setValue(newDate);
	} else{
		if (ev.date.valueOf() > checkoutVA.date.valueOf()) {
			newDate.setDate(newDate.getDate() + 1);
			checkoutVA.setValue(newDate);
		}
	}
  	var startD1 = new Date(ev.date);
	var endD1 = new Date(checkoutVA.date);
	rateCalc(startD1, endD1);
	
	checkinVA.hide();
	focusObj($('#dpvv2')[0],'focus');
}).data('datepicker');

var checkoutVA = $('#dpvv2').datepicker({
	format: 'dd/mm/yyyy',
	// minDate: checkinVA.date,
	beforeShowDay: availDates,
	onRender: function(date) {
		// console.log(availDates)
		var newDate;
		if($('input[name="price_type"]').val() == '2'){
			newDate = dateInc(checkinVA.date.valueOf());
			// $('#dpvv2').datepicker('setValue', newDate);
			return date.valueOf() < newDate ? 'disabled' : '';
		} else {
			newDate = checkinVA.date.valueOf();
			return date.valueOf() <= newDate ? 'disabled' : '';
		}
	}
}).on('changeDate', function(ev) {
	var startD2 = new Date(checkinVA.date);
	var endD2 = new Date(ev.date);
	rateCalc(startD2, endD2);
	checkoutVA.hide();
}).data('datepicker');

$('#week_change').on('change', function(e){
	e.preventDefault();
	var totdate = $(this).val();
    var dd = new Date(checkinVA.date);
    var nextW = new Date(dd.valueOf() + 1000*3600*24*totdate);
    var currDateW = nextW.getDate();
    var currMonthW = nextW.getMonth()+1;
    var currYearW = nextW.getFullYear();
    var dateStrnew = ('0'+currDateW).slice(-2)+'/'+('0'+currMonthW).slice(-2) + '/'+currYearW;
	// console.log(dateStrnew);
	$("#dpvv2").datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	}).datepicker("setValue", dateStrnew);
	rateCalc();
	// console.log(data.price_type)
	// if(data.price_type == 'per week'){
		$('#weekdate').html(dateStrnew);
	// }
});

function dateInc(customDateValue) {
	var totdate,dd,nextW,currDateW,currMonthW,currYearW,dateStrnew;
	totdate = 7;
	// dd = new Date(customDate);
    nextW = new Date(customDateValue + 1000*3600*24*totdate);
    // currDateW = nextW.getDate();
    // currMonthW = nextW.getMonth()+1;
    // currYearW = nextW.getFullYear();
    // dateStrnew = ('0'+currDateW).slice(-2)+'/'+('0'+currMonthW).slice(-2) + '/'+currYearW;
    return nextW;
}



function rateCalc(startD='',endD='') {
	var refNo = $('#dpvv1').attr('price-refNo');
	var villaCode = $('#dpvv1').attr('price-villaCode');
	var searchId = $('#dpvv1').attr('price-searchId');
	var session_id = $('#dpvv1').attr('price-session_id');
	var date1 = $('#dpvv1').val();
	var date2 = $('#dpvv2').val();
	// console.log(date1);
	// console.log(date2);
	$.ajax({
      url: siteUrl + 'villa/calcRateAvail',
      data: '&departDate='+date1+'&returnDate='+date2+'&refNo='+refNo+'&villaCode='+villaCode+'&searchId='+searchId+'&session_id='+session_id,
      dataType: 'json',
      type: 'POST',
      success: function(data) {
        $("#duration").html(data.duration);
		$('#pricetype').html(data.price_type);
		$('#priceperrate').html(data.priceperrate);
		$('.priceperrate').html(data.priceperrate);
		$('#totalprice').html(data.totalprice);
      }
    });

    /*var duration = 1;
	var diff = parseInt((endD.getTime()-startD.getTime())/(24*3600*1000));
	var duration_int = diff;
	var price_type = $('#dpvv1').attr('price-type');
	var price_val = $('#dpvv1').attr('price-val');
	if(price_type==1) {
		price_type = 'per night';
		duration = diff+' Nights';
	} else  {
		price_type = 'per week';
		duration_int = parseInt((diff/7), 10);
		if(duration_int <= 0) {
		  duration_int = 1;
		}
		duration = duration_int+' Weeks';
	}
	$("#duration").html(duration);
	$('#pricetype').html(price_type);
	$('#totalprice').html(duration_int*price_val);
	// console.log(duration_int);
	// console.log(price_val);*/
}



//date picker for hotels room
var checkinH5 = $('#dph5').datepicker({
  format: 'dd/mm/yyyy',
  // defaultDate: dateStr,
  onRender: function(date) {
	return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  // if (ev.date.valueOf() > checkoutH6.date.valueOf()) {
	var newDate = new Date(ev.date)
	newDate.setDate(newDate.getDate() + 1);
	checkoutH6.setValue(newDate);
  // }
  checkinH5.hide();
  focusObj($('#dph6')[0],'focus');
}).data('datepicker');

var checkoutH6 = $('#dph6').datepicker({
  format: 'dd/mm/yyyy',
  onRender: function(date) {
	return date.valueOf() <= checkinH5.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  	checkoutH6.hide();
	var totdaydiff=calculateDate(parseDate($('#dph5').val()),parseDate($('#dph6').val()));
	$night=$("#datadiffnight").attr("data-val");
	$("#datadiff").val(totdaydiff+" "+$night);
	$("#datadiffnight").html(totdaydiff+" "+$night);
}).data('datepicker');


function calculateDate(date1, date2){
//our custom function with two parameters, each for a selected date
 
  diffc = date1.getTime() - date2.getTime();
  //getTime() function used to convert a date into milliseconds. This is needed in order to perform calculations.
 
  days = Math.round(Math.abs(diffc/(1000*60*60*24)));
  //this is the actual equation that calculates the number of days.
 
return days;
}

function parseDate(input) {
  var parts = input.split("/");
  // new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
  return new Date(parts[2], parts[1]-1, parts[0]); // months are 0-based
}
