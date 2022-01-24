// Lab1.cpp : This file contains the 'main' function. Program execution begins and ends there.
//


#include "Header.h"
using namespace std;


int parse_file(vector <string>&vstring, char* cstring) {
	string ifstring;
	ifstream ifs;
	ifs.open(cstring); 
	if (ifs.is_open()) { //if sucessfully opened file 

	
		while (ifs>>ifstring) {
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

	cout << program_name << " <input_file _name>"<< endl;
	return errorinvalidinput; 
}

//main method 

int main(int argc, char* argv[]) {

	//check number of input 

	if (argc != NUM_ARGS) {
		return usage(argv[programname]);
	}

	

	vector<string> v; 
	
	int returnValue= parse_file(v, argv[inputfilename]);
	
	if (returnValue != success) { //if the return value is not success 
		return returnValue;
	}


	
	
	vector<int> intV;

	
	for (string i : v) {

		//itereate over the string and check if each character is numeric 
		bool numeric = true; 

		
		for (char c : i) {
			if (!isdigit(c)) {
				numeric = false; 
				
			}
			
		}

		if (numeric) {
			istringstream iss(i);
			int temp;
			iss >> temp;
			intV.push_back(temp);
		}

		else {
			cout << "Non-digit strings: "; 
			cout << i << endl;
		}
		
	}


	//iterate through vector of int 
	for (int i : intV) {
		cout << i << endl; 
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
