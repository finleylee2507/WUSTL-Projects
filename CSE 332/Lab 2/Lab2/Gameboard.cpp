#include "Gameboard.h"
#include "Header.h"
#include <iostream>


/*method declaration*/

int read_gameboard(ifstream& ifs, unsigned int & x, unsigned int & y) {
	
		string s = "";
	

		if (!getline(ifs, s)) {
			return error_reading_line;
		}
		
		istringstream iss(s);//wrap string in an istringstream

		if (!(iss >> x)) {//extract first value
			return error_extracting_dimensions;
		}

		if (!(iss >> y)) { //extract second value 
			return error_extracting_dimensions;
		}
		
	
		return extraction_success;

}


int read_gamepieces(ifstream& ifs, vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical) {
	string s = "";
	int count2 = 0; //for # of well-formed piece 
	while (getline(ifs, s)) { //while there're still ines to read
		istringstream iss(s); //wrap line in an istringstream
		string gamepiece_color = "";
		string gamepiece_name = "";
		string display = "";
		unsigned int x;
		unsigned int y; 
		int count = 0; //for extraction
		

		if ((iss >> gamepiece_color)) {
			if (gamepiece_color == "red" || gamepiece_color == "white" || gamepiece_color == "blue") {
				count++;
			}
			
		}
		if ((iss >> gamepiece_name)) {
			count++;
		}
		if ((iss >> display)) {
			count++;
		}
		if ((iss >> x)) {
			count++;
		}
		if ((iss >> y)) {
			count++;
		}

		//check if all five values are extracted successfully 

		if (count == 5) {
			//convert first string to enum label
			enum piece_color color = string_to_color(gamepiece_color);

			//compare horizontal, vertical to corresponding dimensions 
			if (x >= x_horizontal || y >= y_vertical) {
				continue; 

			}
			else {
				int index = (x_horizontal * y) + x;
				gp[index].color =color;
				gp[index].display = display;
				gp[index].name = gamepiece_name;
				count2++;
			}
		}

		else { //skip over to the next line 
			continue;
		}
		

	}

	if (count2 >= 1) {
		return read_success;
	}
	else if (count2<1){
		return fail_to_find_well_formed_pieces;
	}

}

int print_out_pieces(const vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical) {

	//check dimension
	if (gp.size() < x_horizontal * y_vertical) {
		return wrong_size; 
	}

	int row = y_vertical-1; //starts at the top row 
	
	for (row; row >= 0; --row) {
		for (int col = 0; col < x_horizontal; ++col) {
			int index = (x_horizontal * row) + col;
			cout << gp[index].display<<" ";
	  }
		cout << endl;	
	}



	return print_success;
}

