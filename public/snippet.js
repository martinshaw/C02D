componentToHex= function(c) {
	var hex = c.toString(16);
	return hex.length == 1 ? "0" + hex : hex;
}

rgbToHex= function(r, g, b) {
	return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}

get_color= function(oto){
	percent= oto*100;
	r = percent<50 ? 255 : Math.floor(255-(percent*2-100)*255/100);
	g = percent>50 ? 255 : Math.floor((percent*2)*255/100);
	return rgbToHex(r,g,0);
}
