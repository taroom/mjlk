function converterToMc(satuan, value)
{
	//satuan MC
	var conv = 0;
	switch(satuan){
		case 'KG':
			conv = value * 0.1;//1 mc = 10 kg, 1 kg = 0.1
		break;
		case 'BL':
			conv = value * 40;//1 blung = 40 mc
		break;
		case 'KR'://karung
			conv = value * 20;
		break;
		case 'SK'://sak
			conv = value * 5;
		break;
		case 'PL'://plastik
			conv = value * 2;
		break;
		default:
			conv = value;
		break;
	}

	return conv;
}