#pragma once
#ifndef Gamepieces
#define Gamepieces
using namespace std;
#include<string>

//enum for colors of game pieces 
enum piece_color {
	red,
	black,
	white,
	invalid_color,
	no_color

};



/*functions declaration*/

string color_to_string(enum piece_color color); 


enum piece_color string_to_color(string s);



/*classes and structs*/

struct games_pieces {
	enum piece_color color;
	string name; //string variable to hold the name of the piece
	string display; //string variable to represent how the piece should be displayed when a game board containing it is printed out
};











#endif /*Gamepieces*/