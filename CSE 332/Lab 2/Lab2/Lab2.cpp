// Lab2.cpp : This file contains the 'main' function. Program execution begins and ends there.
//

#include <iostream>
#include "Header.h"
using namespace std;


int parse_file(vector <string>& vstring, char* cstring) {
	string ifstring;
	ifstream ifs;
	ifs.open(cstring);
	if (ifs.is_open()) { //if sucessfully opened file 


		while (ifs >> ifstring) {
			//if the string is not empty
			if (ifstring != " ") {
				vstring.push_back(ifstring);
			}

		}


	}
	else { //if file is not opened for some reasons 
		return erroropeningfile;
	}


	return success;
}


//usage message when invalid input is entered 
int usage(const char* program_name) {

	cout << program_name << " <input_file _name>" << endl;
	return errorinvalidinput;
}


//method to covert to lowercase

string& toLowerCase(string& s) {

	for (char c : s) {
		c += 32;
	}
	return s;

}
//main method 

int main(int argc, char* argv[]) {

	//check number of input 

	if (argc != NUM_ARGS) {
		return usage(argv[programname]);
	}

	ifstream ifs;
	ifs.open(argv[inputfilename]);

	
	if (ifs.is_open()) {
		unsigned int width;
		unsigned int height;

		//read gameboard
		int result = read_gameboard(ifs, width, height);
		while (result == error_extracting_dimensions) {
			result=read_gameboard(ifs, width, height);
		}
		
		//if no valid line at the end of the file
		if (result == error_reading_line) {
			cout << "The program can't extract useful information from the file" << endl;
			return errorinvalidinput;
		}

		//create vector
		vector<games_pieces> v; 

		//push gamepieces onto vector 
		for (int i = 0; i < width * height; ++i) {
			games_pieces gp;
			gp.color = no_color;
			gp.display = "";
			gp.name = "";
			v.push_back(gp);
		}

		//read gamepieces from input file stream
		if (read_gamepieces(ifs, v, width, height) == fail_to_find_well_formed_pieces) {
			cout << "Failed to read gamepieces from input file stream" << endl; 
			return fail_to_find_well_formed_pieces;
		}

		//pass the vector of game pieces and the horizontal and vertical dimensions of the game board
		//into a call to the function that prints out the game board

		return print_out_pieces(v, width, height);
		

	}

		else { //file not opened successfully
		cout << "Error opening file" << endl;
		return erroropeningfile; 
	}






	return success;

}

// Run program: Ctrl + F5 or Debug > Start Without Debugging menu
// Debug program: F5 or Debug > Start Debugging menu

// Tips for Getting Started: 
//   1. Use the Solution Explorer window to add/manage files
//   2. Use the Team Explorer window to connect to source control
//   3. Use the Output window to see build output and other messages
//   4. Use the Error List window to view errors
//   5. Go to Project > Add New Item to create new code files, or Project > Add Existing Item to add existing code files to the project
//   6. In the future, to open this project again, go to File > Open > Project and select the .sln file
