// Lab3.cpp : This file contains the 'main' function. Program execution begins and ends there.
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

	cout << program_name << " TicTacToe" << endl;
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

	////check number of input and content

	if (argc != NUM_ARGS||string(argv[inputfilename])!="TicTacToe") {
		return usage(argv[programname]);
	}
	TicTacToeGame game; 
	return game.play();

	return success;

}