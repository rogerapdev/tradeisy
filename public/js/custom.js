$(function() {

	$('.date-mask').mask('00/00/0000');
	$('.money-mask').maskMoney({prefix:'R$ ', allowZero:true, allowNegative: false, thousands:'.', decimal:',', precision: 2, affixesStay: false});
	$('.decimal-mask').maskMoney({allowZero:true, allowNegative: false, thousands:'.', decimal:',', precision: 2, affixesStay: false});
	$('.decimal-four-mask').maskMoney({allowZero:true, allowNegative: false, thousands:'.', decimal:',', precision: 4, affixesStay: false});
	$('.integer-mask').maskMoney({allowZero:false, allowNegative: false, thousands:'.', decimal:',', precision: 0, affixesStay: false});
	
});