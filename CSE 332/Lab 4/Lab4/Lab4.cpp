// Lab4.cpp : This file contains the 'main' function. Program execution begins and ends there.
//

#include "header.h"
#include <iostream>
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
	cout << program_name << " Gamename" << endl;
	return errorinvalidinput;
}

//method to covert to lowercase
string& toLowerCase(string& s) {
	for (char c : s) {
		c += 32;
	}
	return s;
}


int main(int argc, char* argv[])
{
 //pass arguments into static method 
	//GameBase* result = GameBase::chooseGame(argc, argv);
	//shared_ptr<GameBase>result
	//https://stackoverflow.com/questions/13311580/error-using-stdmake-shared-abstract-class-instantiation
	shared_ptr<GameBase> result;
	result.reset(GameBase::chooseGame(argc, argv));

	//if returned a singular pointer
	if (result == 0) {
		return usage(argv[programname]);
	}
	else {
		return result->play();
	}

	
}