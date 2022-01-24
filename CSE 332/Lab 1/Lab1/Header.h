#pragma once
#ifndef Header
#define Header 

//citation: https://www.learncpp.com/cpp-tutorial/45-enumerated-types/
//https://piazza.com/class/k58pv8mp2p52wh?cid=51

/* necessary libraries */
#include <vector>
#include <string>
#include <iostream>
#include <fstream>
#include<sstream>

//enum for array indices 

// programname = 0, inputfilename = 1
enum Array {
	programname,
	inputfilename

};



//enum for results 

enum Result {
	success =0,
	erroropeningfile=-1,
	errorinvalidinput=-2


};

/* function declarations */
int parse_file(std::vector<std::string>& vstring, const char* cstring);
int usage(const char* program_name);

#define NUM_ARGS 2							// number of arguments required



#endif /*Header*/
