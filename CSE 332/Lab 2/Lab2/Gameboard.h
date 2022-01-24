#pragma once
#ifndef Gameboard
#define Gameboard
#include <vector>
#include <string>
#include <iostream>
#include <fstream>
#include<sstream>
#include"Gamepieces.h"
using namespace std;


/*enums*/

enum extraction_result {
	extraction_success = 0,
	error_reading_line = -1,
	error_extracting_dimensions = -2

};

enum read_gamepieces_result {
	read_success=0,
	fail_to_find_well_formed_pieces=-1
};

enum print_gamepieces_result {
	print_success=0,
	wrong_size=-1
	
};
/*functions declaration*/

int read_gameboard(ifstream& ifs, unsigned int & x, unsigned int & y);

int read_gamepieces(ifstream& ifs, vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical);

int print_out_pieces(const vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical);



#endif /*Gameboard*/