#include "Gamepieces.h"
#include "Header.h"
#include <iostream>
using namespace std;

/*method definitions*/

//cover an color enum to a corresponding color string 
string color_to_string(enum piece_color color) {

	string s = "";
	if (color == red) {
		s = "red";
	}
	if (color == black) {
		s = "black";
	}
	if (color == white) {
		s = "white";
	}

	return s;
}

//conver a string to a corresponding color enum
enum piece_color string_to_color(string s) {

	if (s == "red") {
		return red;
	}

	else if (s == "black") {
		return black;
	}

	else if (s == "white") {
		return white;
	}
	else if (s == "" || s == " ") {
		return no_color;
	}
	else {
		return invalid_color;
	}
}