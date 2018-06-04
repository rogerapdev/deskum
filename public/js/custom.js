$(function () {

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].styled, input[type="radio"].styled').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });

    $('.select-search').select2({
   		"language": "pt-BR",
   		theme: "bootstrap4"
	});


	// Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};
	$.jMaskGlobals.watchDataMask = true;

	$('.phone-mask').mask(SPMaskBehavior, spOptions);

	$('.zip-code-mask').mask('00000-000');
	$('.social-number-mask').mask('000.000.000-00');
	$('.business-social-number-mask').mask('00.000.000/0000-00');
	$('.identity-number-mask').mask('00.000.000-0');


	$('.date-mask').mask('00/00/0000');
	$('.time-mask').mask('00:00');
	$('.money-mask').maskMoney({prefix:'R$ ', allowZero:true, allowNegative: false, thousands:'.', decimal:',', precision: 2, affixesStay: false});
	$('.decimal-mask').maskMoney({prefix:'', allowZero:true, allowNegative: false, thousands:'.', decimal:',', precision: 2, affixesStay: false});
	$('.integer-mask').maskMoney({prefix:'', allowZero:true, allowNegative: false, thousands:'.', decimal:',', precision: 0, affixesStay: false});


	$(document).on("focus", ".phone-mask", function() { 
		$(this).mask(SPMaskBehavior, spOptions);
	});

	$(document).on("focus", ".zip-code-mask", function() { 
		$(this).mask('00000-000');
	});

	$(document).on("focus", ".social-number-mask", function() { 
		$(this).mask('000.000.000-00');
	});

	$(document).on("focus", ".business-social-number-mask", function() { 
		$(this).mask('00.000.000/0000-00');
	});
	
	$(document).on("focus", ".identity-number-mask", function() { 
		$(this).mask('00.000.000-0');
	});

	$(document).on("focus", ".date-mask", function() { 
		$(this).mask('00/00/0000');
	});

    $(".date-picker").flatpickr({
        allowInput: true,
        dateFormat: "d/m/Y",
        "locale": "pt"
    });


	$('.only-number').on('keydown', function(evt) {
	    var key = evt.charCode || evt.keyCode || 0;

	    return (key == 8 ||
	            key == 9 ||
	            key == 46 ||
	            key == 110 ||
	            key == 190 ||
	            (key >= 35 && key <= 40) ||
	            (key >= 48 && key <= 57) ||
	            (key >= 96 && key <= 105));
	});

});

